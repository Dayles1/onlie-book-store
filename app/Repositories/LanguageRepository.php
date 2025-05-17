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
    public function show($id)
    {
        $language = Language::findOrFail($id);
        return $language;
    }
    public function store($request)
    {
        $language = Language::create($request->only('name', 'prefix', 'is_active'));
        return $language;

    }
    public function update($request,$id)
    {
         $language = Language::findOrFail($id);
        $language->update([       
            'name' => $request['name'],
            'prefix' => $request['prefix'],
            'is_active' => $request['is_active'],
       ]);
        return $language;
    }
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
    }
   
}
