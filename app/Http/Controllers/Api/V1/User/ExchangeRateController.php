<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\Setting;
use App\Models\ExchangeRate;
use App\Http\Controllers\Controller;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $language = Setting::where('key', 'language')->first()->value ?? 'en';
        $nameField = match ($language) {
            'ru' => 'name_ru',
            'uz' => 'name_uz',
            default => 'name_en',
        };

        $rates = ExchangeRate::select('code', 'rate', 'date', $nameField)->get();

        return response()->json([
            'language' => $language,
            'rates' => $rates
        ]);
    }
}