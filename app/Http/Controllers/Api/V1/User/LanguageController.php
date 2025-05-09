<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LanguageResorce;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Cache::remember('active_languages', 3600, function () {
            return Language::where('is_active', true)->get();
        });

        return $this->success( new LanguageResorce($languages), __('message.lang.show_success'));
    }
    public function show($id)
    {
        $language = Language::findOrFail($id);

        return $this->success(new LanguageResorce($language), __('message.lang.show_success'));
    }
   
}
