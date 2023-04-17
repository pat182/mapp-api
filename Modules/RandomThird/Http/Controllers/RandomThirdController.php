<?php

namespace Modules\RandomThird\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\CurrencyService;
use Modules\RandomThird\Http\Requests\CurrencyRequest;

class RandomThirdController extends Controller
{
    public function __construct(CurrencyService $curService){

        $this->curService = $curService;

    }

    public function index(Request $req)
    {
        
        return response()->json( $this->curService->getCur('GET','currencies',$req->query()) );
    }

    public function convertCurrencies(CurrencyRequest $req){
        
        return response()->json( $this->curService->convertCurrencies('GET','latest',$req->payload()) );
        
    }

    

  
}
