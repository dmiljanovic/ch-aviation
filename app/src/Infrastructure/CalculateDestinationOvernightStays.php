<?php

namespace App\Infrastructure;

use Carbon\Carbon;

class CalculateDestinationOvernightStays
{
    public static function calculate(array $data): array
    {
        $flightsGroupByRegistration = [];

        //group flights by airplane
        foreach ($data as $item) {
            $flightsGroupByRegistration[$item['registration']][] = $item;
        }


        $res = [];
        $flightBefore = null;

        foreach ($flightsGroupByRegistration as $registration => $flights) {
            foreach ($flights as $flight) {
                if ($flightBefore === null || $flight['registration'] !== $registration) {
                    $flightBefore = $flight;

                    continue;
                }

                if (
                    Carbon::parse($flightBefore['actual_end'])->endOfDay()->gt(Carbon::parse($flightBefore['actual_end']))
                    && Carbon::parse($flight['actual_start'])->gt(Carbon::parse($flightBefore['actual_end'])->endOfDay())
                ) {

                    if (!isset($res[$flightBefore['to']])) {
                        $res[$flightBefore['to']]['overnight_stays'] = 0;
                    }
                    $res[$flightBefore['to']]['overnight_stays'] += 1;
                }

                $flightBefore = $flight;
            }
        }

        uasort($res, function ($a, $b) {
            return $a['overnight_stays'] > $b['overnight_stays'];
        });


        return array_slice($res, -1, 1, true);
    }
}
