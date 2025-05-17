<?php

namespace App\Services;
use App\Interfaces\Repositories\LanguageRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Interfaces\Services\LanguageServiceInterface;

class LanguageService extends BaseService implements LanguageServiceInterface
{
    public function __construct(protected LanguageRepositoryInterface $languageRepository){}
   
   public function index(){
    $languages=$this->languageRepository->index();
    
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
