<?php

namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
   
    public function created(Language $language)
    {
        $this->updateCache();
    }

   
    public function updated(Language $language)
    {
        $this->updateCache();
    }

    
    public function deleted(Language $language)
    {
        $this->updateCache();
    }

    
    
    protected function updateCache()
    {
        Cache::forget('active_languages');
        Cache::remember('active_languages', 3600, function () {
            return Language::where('is_active', true)->get();
        });
    }
}