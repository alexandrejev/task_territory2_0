<?php

namespace App\Farm;

use Illuminate\Support\Collection;

class Chicken extends Animal
{
    protected string $type="Курица";

    function getProduction():Collection {
        $production=new Collection();
        $produced=$this->productGenerator(0,1);
        for($i=0;$i<$produced;$i++)
            $production->add(new Egg());
        return $production;
    }
}
