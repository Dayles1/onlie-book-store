<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\TranslationStoreRequest;
use App\Http\Requests\TranslationUpdateRequest;

class TranslationController extends Controller
{
    

    public function store(TranslationStoreRequest $request)
    {
      

        $translation = Translation::create($request->all());


        return $this->success($translation, __('message.translation.create_success'), 201);
    }

    public function update(TranslationUpdateRequest $request, $id)
    {
        $translation = Translation::findOrFail($id);
        $translation->update($request->all());


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


        return $this->success([], __('message.translation.delete_success'));
    }
}
