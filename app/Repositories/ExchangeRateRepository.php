<?php

namespace App\Repositories;

use App\Models\ExchangeRate;
use App\Interfaces\Repositories\ExchangeRateRepositoryInterface;

class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
        
    public function index()
    {
        $exchangeRates = ExchangeRate::paginate(10);
        return $exchangeRates;
    }
    public function store($request)
    {
         $exchangeRate = ExchangeRate::create([
            'code' => $request->code,
            'rate' => $request->rate,
            'date' => $request->date,
        ]);
        return $exchangeRate;
    }
    public function update($request, $id)
    {
           $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update([
            'rate' => $request->rate,
            'date' => $request->date,
        ]);
        return $exchangeRate;
    }
    public function destroy($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->delete();
    }
}
