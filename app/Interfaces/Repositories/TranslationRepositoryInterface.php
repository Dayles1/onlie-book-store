<?php

namespace App\Interfaces\Repositories;

interface TranslationRepositoryInterface
{
    public function index();
    public function find($find);
    public function store($request);
    public function update($request);
    public function destroy();
}
