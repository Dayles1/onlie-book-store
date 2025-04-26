<?php

namespace App\Observers;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class TranslationObserver
{
    
    public function created(Translation $translation)
    {
        $this->updateCache($translation->locale);
    }

   
    public function updated(Translation $translation)
    {
        $this->updateCache($translation->locale);
    }

    
    public function deleted(Translation $translation)
    {
        $this->updateCache($translation->locale);
    }

    
    protected function updateCache($locale)
    {
        Cache::forget("translations_{$locale}");
        Cache::remember("translations_{$locale}", 3600, function () use ($locale) {
            return Translation::where('is_active', true)
                             ->where('locale', $locale)
                             ->get();
        });
    }
}