<?php
namespace App\Repositories;

use App\Interfaces\Repositories\TranslationRepositoryInterface;
use App\Models\Translation;

class TranslationRepository implements TranslationRepositoryInterface
{
    public function index($locale)
    {
        return Translation::where('is_active', true)
            ->when($locale, function ($query, $locale) {
                return $query->where('lang_prefix', $locale);
            });
    }

    public function find($id)
    {
        return Translation::find($id);
    }

    public function store($request)
    {
        return Translation::create([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);
    }

    public function update($request, $id)
    {
        $translation = Translation::findOrFail($id);
        $translation->update([
            'key' => $request->key,
            'value' => $request->value,
            'lang_prefix' => $request->lang_prefix,
            'is_active' => $request->is_active,
        ]);

        return $translation;
    }

    public function destroy($id)
    {
        $translation = Translation::findOrFail($id);
        return $translation->delete();
    }
}
