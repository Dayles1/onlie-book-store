<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class SyncExchangeRates extends Command
{
    protected $signature = 'currency:sync';
    protected $description = 'Fetch daily exchange rates from CBU.uz and store in database';

    public function handle()
    {
        $url = 'https://cbu.uz/uz/arkhiv-kursov-valyut/json/';
        $response = Http::get($url);

        if (!$response->ok()) {
            $this->error('Kurslarni olishda xatolik!');
            return;
        }

        $data = $response->json();

        $needed = collect($data)->whereIn('Ccy', ['USD', 'RUB']);

        foreach ($needed as $rate) {
            ExchangeRate::updateOrCreate(
                [
                    'code' => $rate['Ccy'],
                    'date' => Carbon::createFromFormat('d.m.Y', $rate['Date'])->toDateString()
                ],
                [
                    'rate' => str_replace(',', '.', $rate['Rate'])
                ]
            );
        }

        $this->info('Kurslar muvaffaqiyatli yangilandi.');
    }
}
