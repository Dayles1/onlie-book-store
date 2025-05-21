<?php namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ExchangeRateService;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Requests\ExchangeRateStoreRequest;
use App\Http\Requests\ExchangeRateUpdateRequest;
use App\Interfaces\Services\ExchangeRateServiceInterface;

        class ExchangeRateController extends Controller
{
    public function __construct(protected ExchangeRateServiceInterface $exchangeRateService)
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
        $exchangeRate = $this->exchangeRateService->store($request->validated());
        return $this->success(new ExchangeRateResource($exchangeRate), __('message.exchange_rate.create_success'));
    }
    public function update(ExchangeRateUpdateRequest $request, $id)
    {
        $exchangeRate = $this->exchangeRateService->update($request->validated(), $id);
        return $this->success(new ExchangeRateResource($exchangeRate), __('message.exchange_rate.update_success'));
    }
    public function destroy($id)
    {
        $exchangeRate = $this->exchangeRateService->destroy($id);
        return $this->success(null, __('message.exchange_rate.delete_success'), 204);
    }
}
