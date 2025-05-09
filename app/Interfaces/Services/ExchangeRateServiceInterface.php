<?php

namespace App\Interfaces\Services;

interface ExchangeRateServiceInterface
{
    public function index(); 
    public function store($request); 
    public function update($data, $id);
    public function destroy($id);    
}
