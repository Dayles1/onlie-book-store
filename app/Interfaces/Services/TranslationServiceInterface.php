<?php

namespace App\Interfaces\Services;

interface TranslationServiceInterface
{
    public function index($request);
    public function store($request);
    public function update($request, $id);  
    public function destroy($id);

}
