<?php
namespace App\Services\InternetServiceProvider;

use App\Services\InternetServiceProvider\WifiCalculatorInterface;

class WifiCalculatorService implements WifiCalculatorInterface {

    public function calculateTotalAmount(string $service, int $month)
    {
        if($service == 'mpt'){
            $mpt =  new Mpt();
            $mpt->setMonth($month);
            return $mpt->calculateTotalAmount();
        }

        if($service == 'ooredoo'){
            $ooredoo = new Ooredoo();
            $ooredoo->setMonth($month);
            return $ooredoo->calculateTotalAmount();
        }
    }
}