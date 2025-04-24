<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::where('is_active', true)->get();
        return $this->success($languages, __('message.lang.show_success'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'prefix' => 'required|string|unique:languages,prefix',
        ]);

        $language = Language::create($request->only('name', 'prefix', 'is_active'));
        return $this->success($language, __('message.lang.create_success'), 201);
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());

        return $this->success($language, __('message.lang.update_success'));
    }

    public function destroy($id)
    {
        $language = Language::find($id);
        if (!$language) return $this->error(__('message.lang.not_found'), 404);

        $language->delete();
        return $this->success([], __('message.lang.delete_success'));
    }
}

