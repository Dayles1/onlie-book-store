<?php

namespace App\Interfaces\Repositories;

interface ExchangeRateRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}
