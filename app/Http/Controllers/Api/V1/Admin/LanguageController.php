<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;

class LanguageController extends Controller
{
    public function store(LanguageStoreRequest $request)
    {
        

        $language = Language::create($request->only('name', 'prefix', 'is_active'));


        return $this->success($language, __('message.lang.create_success'), 201);
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());


        return $this->success($language, __('message.lang.update_success'));
    }

    public function destroy($id)
    {
        $language = Language::findOrFsil($id);
        

        $language->delete();


        return $this->success([], __('message.lang.delete_success'));
    }
}
