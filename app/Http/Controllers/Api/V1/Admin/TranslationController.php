<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\TranslationStoreRequest;
use App\Http\Requests\TranslationUpdateRequest;
use App\Interfaces\Services\TranslationServiceInterface;

class TranslationController extends Controller
{
     public function __construct(protected TranslationServiceInterface $translationService)
    {
    }

    public function store(TranslationStoreRequest $request)    {
      

        $translation = Translation::create([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);


        return $this->success($translation, __('message.translation.create_success'), 201);
    }

    public function update(TranslationUpdateRequest $request, $id)
    {
        $translation = Translation::findOrFail($id);
        $translation->update([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);


        return $this->success($translation, __('message.translation.update_success'));
    }

    public function destroy($id)
    {
        $translation = Translation::findOrFsil($id);
       

        // $locale = $translation->locale;
        $translation->delete();


        return $this->success([], __('message.translation.delete_success'));
    }
}
