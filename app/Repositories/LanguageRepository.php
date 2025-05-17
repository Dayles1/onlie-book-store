<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageRepository
{
    public function index()
    {
$languages = Cache::remember('active_languages', 3600, function () {
        return Language::where('is_active', true)->get();
    });
        return $languages;
    }
    public function show($find)
    {}
    public function store($request)
    {

    }
    public function update($request,$id)
    {

    }
    public function destroy($id)
    {

    }
   
}
