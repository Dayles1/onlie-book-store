<?php

namespace App\Services;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\Services\TranslationServiceInterface;

class TranslationService extends BaseService implements TranslationServiceInterface
{
  public function index($request)
  {
     $locale = $request->header('locale');
        
        $translations = Cache::remember("translations_{$locale}", 3600, function () use ($locale) {
            $translations = Translation::where('is_active', true);
            if ($locale) {
                $translations->where('locale', $locale);
            }
            return $translations->get();
        });
        return $translations;
  }
    public function store($request)
    {
        
        $translation = Translation::create([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);
        return $translation;
     
    }
    public function update($request, $id)
    {
      $translation = Translation::findOrFail($id);
        $translation->update([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);
        return $translation;    
       
    }
    public function destroy($id){

    }
   
    

}
