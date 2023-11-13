<?php

namespace App\Infrastructure;

use Carbon\Carbon;

class CalculateMostMissedScheduledLandings
{
    public const LANDING_STATUS_MISSED = 'missed';
    public const LANDING_STATUS_ON_TIME = 'on time';

    public static function calculate(array $data): array
    {
        $res = [];

        foreach ($data as $k => $item) {
            $lendingStatus = Carbon::parse($item['scheduled_end'])->diffInMinutes(Carbon::parse($item['actual_end']))  > 5 ? self::LANDING_STATUS_MISSED : self::LANDING_STATUS_ON_TIME;

            $data[$k]['lending_status'] = $lendingStatus;

            if(!isset($res[AirlineLookup::from($item['registration'])])) {
                if ($lendingStatus === self::LANDING_STATUS_MISSED) {
                    $res[AirlineLookup::from($item['registration'])]['lending_status']['missed'] = 1;
                    $res[AirlineLookup::from($item['registration'])]['lending_status']['on time'] = 0;
                } else {
                    $res[AirlineLookup::from($item['registration'])]['lending_status']['missed'] = 0;
                    $res[AirlineLookup::from($item['registration'])]['lending_status']['on time'] = 1;
                }
            } else if ($lendingStatus === self::LANDING_STATUS_MISSED) {
                $res[AirlineLookup::from($item['registration'])]['lending_status']['missed'] += 1;
            } else {
                $res[AirlineLookup::from($item['registration'])]['lending_status']['on time'] += 1;
            }
        }

        uasort($res, function ($a, $b) {
            return $a['lending_status']['missed'] > $b['lending_status']['missed'];
        });

        return array_slice($res, -1, 1, true);
    }
}
