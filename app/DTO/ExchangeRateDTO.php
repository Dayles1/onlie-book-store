<?php

namespace App\DTO;

use Carbon\Carbon;

class ExchangeRateDTO
{
    public string $code;
    public float $rate;
    public Carbon $date;

    public function __construct(string $code, float $rate, string $date)
    {
        $this->code = $code;
        $this->rate = $rate;
        $this->date = Carbon::parse($date);
    }
    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'] ?? '',
            rate: isset($data['rate']) ?? null,
            date: $data['date'] ?? now()->toDateString(),
        );
    }
}
