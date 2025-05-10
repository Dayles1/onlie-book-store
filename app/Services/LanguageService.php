<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Interfaces\Services\LanguageServiceInterface;

class LanguageService extends BaseService implements LanguageServiceInterface
{
   
   public function index(){
    $languages = Cache::remember('active_languages', 3600, function () {
        return Language::where('is_active', true)->get();
    });
    return $languages;
   }
    public function store($request){
        $language = Language::create($request->only('name', 'prefix', 'is_active'));
        return $language;
    }
    public function update($request, $id){
        $language = Language::findOrFail($id);
        $language->update($request->all());
        return $language;
    }
    public function destroy($id){
        $language = Language::findOrFail($id);

        

        $language->delete();
        return ['status' => 'success'];
    }
    public function show($id){
        $language = Language::findOrFail($id);
        return $language;
    }
}
