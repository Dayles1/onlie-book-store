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

        foreach ($data as $rate) {
            ExchangeRate::updateOrCreate(
                [
                    'code' => $rate['Ccy'], // Valyuta kodi
                    'date' => Carbon::createFromFormat('d.m.Y', $rate['Date'])->toDateString() // Sana
                ],
                [
                    'rate' => str_replace(',', '.', $rate['Rate']) 
                ]
            );
        }

        $this->info('Barcha valyuta kurslari muvaffaqiyatli yangilandi.');
    }
}
