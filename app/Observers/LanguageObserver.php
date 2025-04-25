<?php 
namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
    public function created(Language $language)
    {
        Cache::forget('active_languages');
    }

    public function updated(Language $language)
    {
        Cache::forget('active_languages');
    }

    public function deleted(Language $language)
    {
        Cache::forget('active_languages');
    }
}
