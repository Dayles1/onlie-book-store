<?php

namespace App\Interfaces\Repositories;

interface TranslationRepositoryInterface
{
    public function index($locale);
    public function find($find);
    public function store($request);
    public function update($request,$id);
    public function destroy($translation);
}
