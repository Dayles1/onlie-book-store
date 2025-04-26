<?php namespace App\Http\Controllers\Api\V1\User;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\TranslationStoreRequest;
use App\Http\Requests\TranslationUpdateRequest;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->header('locale');
        
        $translations = Cache::remember("translations_{$locale}", 3600, function () use ($locale) {
            $translations = Translation::where('is_active', true);
            if ($locale) {
                $translations->where('locale', $locale);
            }
            return $translations->get();
        });

        return $this->success($translations, __('message.translation.show_success'));
    }

   
}
