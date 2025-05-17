<?php

namespace App\Interfaces\Repositories;

interface LanguageRepositoryInterface
{
    public function index();
    public function show($find);
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
