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
        $language = $this->languageRepository->store($request);
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
        $language = $this->languageRepository->show($id);
        return $language;
    }
}
