<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
{
    $lang = $request->header('lang'); // получаем из заголовка запроса

    $query = Translation::where('is_active', true);

    if ($lang) {
        $query->where('lang_prefix', $lang);
    }

    return response()->json($query->get());
}

}
