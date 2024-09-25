<?php

namespace App\Farm;

use Illuminate\Support\Collection;

class Cow extends Animal
{
    protected string $type="Корова";

    function getProduction():Collection {
        $production=new Collection();
        $produced=$this->productGenerator(8,12);
        for($i=0;$i<$produced;$i++)
            $production->add(new Milk());
        return $production;
    }
}
