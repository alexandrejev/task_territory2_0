<?php

namespace App\Services;

use App\Farm\Animal;
use App\Farm\Product;
use Illuminate\Support\Collection;

class FarmService
{

    private Collection $animals;
    private Collection $production;
    private int $counter=0;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->animals = new Collection();
        $this->production = new Collection();
    }

    public function addAnimal(Animal $animal){
        $this->animals->add($animal
            ->setId($this->getNextId())
        );
        return $this;
    }

    private function getNextId(){
        return ++$this->counter;
    }


    private function getAnimalGroups(){
        return $this->animals->groupBy(function (Animal $item) {
            return $item->getType();
        });
    }

    private function getProductionGroups(){
        return $this->production->groupBy(function (Product $item) {
            return $item->getType();
        });
    }

    private function getAnimalCount(){
        return $this->getAnimalGroups()->map(function ($item) {
            return collect($item)->count();
        });
    }

    private function getProductionCount(){
        return $this->getProductionGroups()->map(function ($item) {
            return collect($item)->count();
        });
    }

    public function collectProduction(){
        $this->animals->each(function (Animal $animal) {
            $this->production=$this->production->merge($animal->getProduction());
        });
    }


    private function collectionKeyValueString(Collection $collection, $glue){
        return $collection
            ->implode(function ($item,$key){
                return "$key: $item";
            },$glue);
    }

    public function getAnimalReport(){
        echo "\nСейчас на ферме живут: \n";
        echo $this->collectionKeyValueString($this->getAnimalCount(),"\n");
        echo "\n";
    }

    public function getProductionReport(){
//        dump($this->getProductionGroups());
        echo "\nПродукция на ферме:\n";
        echo $this->collectionKeyValueString($this->getProductionCount(),"\n");
        echo "\n";
    }
}
