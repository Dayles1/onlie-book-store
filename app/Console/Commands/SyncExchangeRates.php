<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class SyncExchangeRates extends Command
{
    protected $signature = 'currency:sync';
    protected $description = 'Fetch daily exchange rates from CBU.uz and update existing records in the database';

    public function handle()
    {
        $url = 'https://cbu.uz/uz/arkhiv-kursov-valyut/json/';
        $response = Http::get($url);

        if (!$response->ok()) {
            $this->error('Kurslarni olishda xatolik!');
            return;
        }

        $data = $response->json();

        if (empty($data)) {
            $this->error('API qaytargan ma\'lumotlar bo\'sh.');
            return;
        }

        foreach ($data as $rateData) {
            if (isset($rateData['Ccy'], $rateData['Date'], $rateData['Rate'])) {
                $currencyCode = $rateData['Ccy'];
                $rate = str_replace(',', '.', $rateData['Rate']); 
                $date = Carbon::createFromFormat('d.m.Y', $rateData['Date'])->toDateString();

                $exchangeRate = ExchangeRate::where('code', $currencyCode)
                    ->where('date', $date)
                    ->first();

                if ($exchangeRate) {
                    $exchangeRate->update([
                        'rate' => $rate
                    ]);
                    $this->info("Kurs yangilandi: {$currencyCode} - {$date}");
                } else {
                    $this->info("Valyuta {$currencyCode} - {$date} mavjud emas, yangilanishi mumkin emas.");
                }
            } else {
                $this->error("Xatolik: Valyuta kodi yoki kurs yoki sana mavjud emas.");
            }
        }

        $this->info('Barcha mavjud valyutalar muvaffaqiyatli yangilandi.');
    }
}
