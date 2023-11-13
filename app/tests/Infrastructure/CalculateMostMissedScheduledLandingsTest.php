<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\CalculateMostMissedScheduledLandings;
use PHPUnit\Framework\TestCase;

class CalculateMostMissedScheduledLandingsTest extends TestCase
{
    private const INPUT_DATA = [
        0 => [
            "registration" => "HA-AAA",
            "from" => "MAD",
            "to" => "ZAG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T01:30:00+00:00"
        ],
        1 => [
            "registration" => "HA-AAB",
            "from" => "MAD",
            "to" => "BGD",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T02:30:00+00:00"
        ],
        2 => [
            "registration" => "HA-AAC",
            "from" => "MAD",
            "to" => "PDG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T03:30:00+00:00"
        ],
        3 => [
            "registration" => "D-AAA",
            "from" => "MAD",
            "to" => "SAR",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T01:03:00+00:00"
        ],
        4 => [
            "registration" => "D-AAB",
            "from" => "MAD",
            "to" => "LJU",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T01:06:00+00:00"
        ],
        5 => [
            "registration" => "OO-AAA",
            "from" => "MAD",
            "to" => "LJU",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T01:00:00+00:00"
        ],

    ];
    private const EXPECTED_DATA = [
        'Alpha Airlines' =>
            [
                'lending_status' =>
                    [
                        'missed' => 3,
                        'on time' => 0,
                    ],
            ],
    ];

    public function testThreeLongestFlights(): void
    {
        $this->assertSame(self::EXPECTED_DATA, CalculateMostMissedScheduledLandings::calculate(self::INPUT_DATA));
    }
}
