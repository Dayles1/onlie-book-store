<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:translations',
            'value' => 'required',
            'locale' => 'required|string',
        ]);

        $translation = Translation::create($request->all());

        Cache::forget("translations_{$request->locale}");

        return $this->success($translation, __('message.translation.create_success'), 201);
    }

    public function update(Request $request, $id)
    {
        $translation = Translation::findOrFail($id);
        $translation->update($request->all());

        Cache::forget("translations_{$translation->locale}");

        return $this->success($translation, __('message.translation.update_success'));
    }

    public function destroy($id)
    {
        $translation = Translation::find($id);
        if (!$translation) {
            return $this->error(__('message.translation.not_found'), 404);
        }

        $locale = $translation->locale;
        $translation->delete();

        Cache::forget("translations_{$locale}");

        return $this->success([], __('message.translation.delete_success'));
    }
}
