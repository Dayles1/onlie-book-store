<?php

namespace App\Services;

use App\Interfaces\Repositories\ExchangeRateRepositoryInterface;
use App\Models\ExchangeRate;
use App\Interfaces\Services\ExchangeRateServiceInterface;

class ExchangeRateService extends BaseService implements ExchangeRateServiceInterface
{
    public function __construct(protected ExchangeRateRepositoryInterface $exchangeRateRepository ){}
     public function index(){
        $exchangeRates = $this->exchangeRateRepository->index();
        return $exchangeRates;

    }
    public function store($request){
        $exchangeRate = $this->exchangeRateRepository->store($request);
        return $exchangeRate;

    }
    public function update($request, $id){
        $exchangeRate = $this->exchangeRateRepository->update($request, $id);
        return $exchangeRate;
    }   
    public function destroy($id){
        $exchangeRate = $this->exchangeRateRepository->destroy($id);
    }
}

