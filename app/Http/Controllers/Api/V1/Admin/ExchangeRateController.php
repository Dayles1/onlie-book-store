<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\ExchangeRate;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Requests\ExchangeRateStoreRequest;
use App\Http\Requests\ExchangeRateUpdateRequest;

class ExchangeRateController extends Controller
{
    public function __construct(protected ExchangeRateService $exchangeRateService)
    {
    }
    public function index()
    {
        $exchangeRates = $this->exchangeRateService->index();
        return $this->responsePagination(
            $exchangeRates,
            ExchangeRateResource::collection($exchangeRates),
            __('message.exchange_rate.index_success')
        );
    }

    public function store(ExchangeRateStoreRequest $request)
    {
        $exchangeRate = $this->exchangeRateService->store($request);
      

        return $this->success(new ExchangeRateResource($exchangeRate), __('message.exchange_rate.create_success'));
    }

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
