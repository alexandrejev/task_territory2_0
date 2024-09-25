<?php

namespace App\Farm;

use Illuminate\Support\Collection;

abstract class Animal
{
    private int $id;

    protected string $type="Животное";
    function getType(){
        return $this->type;
    }

    abstract function getProduction():Collection;

    public function setId(int $id){
        $this->id = $id;
        return $this;
    }

    protected function productGenerator($min,$max){
        return rand($min,$max);
    }

}
