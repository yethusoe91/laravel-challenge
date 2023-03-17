<?php 
namespace App\Services\InternetServiceProvider;

interface WifiCalculatorInterface
{
    public function calculateTotalAmount(string $service,int $month);
}