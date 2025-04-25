<?php
namespace App\Observers;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class TranslationObserver
{
    public function created(Translation $translation)
    {
        Cache::forget("translations_{$translation->locale}");
    }

    public function updated(Translation $translation)
    {
        Cache::forget("translations_{$translation->locale}");
    }

    public function deleted(Translation $translation)
    {
        Cache::forget("translations_{$translation->locale}");
    }
}
