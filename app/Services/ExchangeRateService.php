<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Interfaces\Services\ExchangeRateServiceInterface;

class ExchangeRateService extends BaseService implements ExchangeRateServiceInterface
{
    public function index(){
        $exchangeRates = ExchangeRate::paginate(10);
        return $exchangeRates;

    }
    public function store($request){
        $exchangeRate = ExchangeRate::create([
            'code' => $request->code,
            'rate' => $request->rate,
            'date' => $request->date,
        ]);
        return $exchangeRate;

    }
    public function update($data, $id){

    }   
    public function destroy($id){

    }
}

