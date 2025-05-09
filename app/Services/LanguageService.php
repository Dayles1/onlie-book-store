<?php

namespace App\Services;

use App\Models\Language;
use App\Interfaces\Services\LanguageServiceInterface;

class LanguageService extends BaseService implements LanguageServiceInterface
{
   public function index(){

   }
    public function store($request){
        $language = Language::create($request->only('name', 'prefix', 'is_active'));
        return $language;
    }
    public function update($request, $id){

    }
    public function destroy($id){

    }
    public function show($id){

    }
}
