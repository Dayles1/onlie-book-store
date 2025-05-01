<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Requests\ExchangeRateStoreRequest;
use App\Http\Requests\ExchangeRateUpdateRequest;

class ExchangeRateController extends Controller
{
    // Valyutalarni olish (GET)
    public function index()
    {
        $exchangeRates = ExchangeRate::paginate(10);

        return $this->responsePagination(
            $exchangeRates,
            ExchangeRateResource::collection($exchangeRates),
            __('message.exchange_rate.index')
        );
    }

    // Yangi valyuta qo'shish (POST)
    public function store(ExchangeRateStoreRequest $request)
    {
        $exchangeRate = ExchangeRate::create([
            'code' => $request->code,
            'rate' => $request->rate,
            'date' => $request->date,
        ]);

        return $this->success(new ExchangeRateResource($exchangeRate), __('message.exchange_rate.create_success'));
    }

    // Valyutani yangilash (PUT/PATCH)
    public function update(ExchangeRateUpdateRequest $request, $id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update([
            'rate' => $request->rate,
            'date' => $request->date,
            
        ]);

        return $this->success(new ExchangeRateResource($exchangeRate), __('message.exchange_rate.update_success'));
    }

    // Valyutani o'chirish (DELETE)
    public function destroy($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->delete();

        return $this->success(null, __('message.exchange_rate.delete_success'), 204);
    }
}
