<?php

namespace App\Infrastructure;

use Carbon\Carbon;

class CalculateThreeLongestFlights
{
    public static function calculate(array $data): array
    {
        foreach ($data as $k => $item) {
            $data[$k]['actual_duration'] = Carbon::parse($item['actual_end'])->diffInMinutes(Carbon::parse($item['actual_start']));
        }

        uasort($data, function ($a, $b) {
            return $a['actual_duration'] > $b['actual_duration'];
        });

        return array_slice($data, -3, 3, true);
    }
}
