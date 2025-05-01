<?php

namespace App\Observers;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class TranslationObserver
{
    public function created(Translation $translation)
    {
        $this->updateCache($translation->lang_prefix);
    }

    public function updated(Translation $translation)
    {
        $this->updateCache($translation->lang_prefix);
    }

    public function deleted(Translation $translation)
    {
        $this->updateCache($translation->lang_prefix);
    }

    protected function updateCache($langPrefix)
    {
        Cache::forget("translations_{$langPrefix}");
        Cache::remember("translations_{$langPrefix}", 3600, function () use ($langPrefix) {
            return Translation::where('is_active', true)
                             ->where('lang_prefix', $langPrefix)
                             ->get();
        });
    }
}
