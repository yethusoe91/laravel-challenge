<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InternetServiceProvider\WifiCalculatorService;

class InternetServiceProviderController extends Controller
{
    protected $calculator;

    public function __construct(WifiCalculatorService $calculator){
        $this->calculator = $calculator;
    }

    public function getMptInvoiceAmount(Request $request)
    {
        $month = $request->get('month') ?: 1;

        $amount = $this->calculator->calculateTotalAmount('mpt', $month);
        
        return response()->json([
            'data' => $amount
        ]);
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $month = $request->get('month') ?: 1;
        $amount = $this->calculator->calculateTotalAmount('ooredoo', $month);

        return response()->json([
            'data' => $amount
        ]);
    }
}
