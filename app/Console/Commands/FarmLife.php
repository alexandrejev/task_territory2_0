<?php

namespace App\Console\Commands;

use App\Farm\Chicken;
use App\Farm\Cow;
use App\Services\FarmService;
use Illuminate\Console\Command;

class FarmLife extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Farms's life";

    /**
     * Execute the console command.
     */
    public function handle(FarmService $farmService)
    {
        for($i=0;$i<10;$i++)
            $farmService->addAnimal(new Cow());

        for($i=0;$i<20;$i++)
            $farmService->addAnimal(new Chicken());

        $farmService->getAnimalReport();

        for($i=0;$i<7;$i++)
            $farmService->collectProduction();

        $farmService->getProductionReport();

        $farmService
            ->addAnimal(new Chicken())
            ->addAnimal(new Chicken())
            ->addAnimal(new Chicken())
            ->addAnimal(new Chicken())
            ->addAnimal(new Chicken())
            ->addAnimal(new Cow())
        ;

        $farmService->getAnimalReport();


        for($i=0;$i<7;$i++)
            $farmService->collectProduction();

        $farmService->getProductionReport();

        echo "\n";
    }
}
