<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExchangeRateController extends Controller
{
    // Valyutalarni olish (GET)
    public function index()
    {
        $exchangeRates = ExchangeRate::all();
        return response()->json($exchangeRates);
    }

    // Yangi valyuta qo'shish (POST)
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:3|unique:exchange_rates,code',
            'rate' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $exchangeRate = ExchangeRate::create([
            'code' => $request->code,
            'rate' => $request->rate,
            'date' => $request->date,
        ]);

        return response()->json([
            'message' => 'Valyuta muvaffaqiyatli qo\'shildi',
            'data' => $exchangeRate,
        ], 201);
    }

    // Valyutani yangilash (PUT/PATCH)
    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update([
            'rate' => $request->rate,
            'date' => $request->date,
        ]);

        return response()->json([
            'message' => 'Valyuta muvaffaqiyatli yangilandi',
            'data' => $exchangeRate,
        ]);
    }

    // Valyutani o'chirish (DELETE)
    public function destroy($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->delete();

        return response()->json(['message' => 'Valyuta muvaffaqiyatli o\'chirildi']);
    }
}
