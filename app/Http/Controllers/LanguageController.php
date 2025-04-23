<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
{
    $langs = Language::where('is_active', true)->get();
    return response()->json($langs);
}

}
