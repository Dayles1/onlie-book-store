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
        // CBU.uz API'dan valyutalar kurslarini olish
        $url = 'https://cbu.uz/uz/arkhiv-kursov-valyut/json/';
        $response = Http::get($url);

        if (!$response->ok()) {
            $this->error('Kurslarni olishda xatolik!');
            return;
        }

        // API'dan olingan ma'lumotlarni olish
        $data = $response->json();

        // Barcha kerakli valyutalar uchun yangilanish
        $currencies = collect($data)->pluck('Ccy'); // Valyuta kodlari (USD, EUR, RUB va h.k.)

        foreach ($currencies as $currency) {
            $rateData = collect($data)->firstWhere('Ccy', $currency); // Har bir valyutaning ma'lumoti

            // Agar valyuta mavjud bo'lsa, yangilash yoki yaratish
            ExchangeRate::updateOrCreate(
                [
                    'code' => $currency,
                    'date' => Carbon::createFromFormat('d.m.Y', $rateData['Date'])->toDateString()
                ],
                [
                    'rate' => str_replace(',', '.', $rateData['Rate'])
                ]
            );
        }

        $this->info('Barcha valyutalar muvaffaqiyatli yangilandi.');
    }
}
