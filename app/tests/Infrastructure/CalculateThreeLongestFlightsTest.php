<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\CalculateThreeLongestFlights;
use PHPUnit\Framework\TestCase;

class CalculateThreeLongestFlightsTest extends TestCase
{
    private const INPUT_DATA = [
        0 => [
            "registration" => "D-AAA",
            "from" => "MAD",
            "to" => "ZAG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T01:30:00+00:00"
        ],
        1 => [
            "registration" => "D-AAB",
            "from" => "MAD",
            "to" => "BGD",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T02:30:00+00:00"
        ],
        2 => [
            "registration" => "D-AAC",
            "from" => "MAD",
            "to" => "PDG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T03:30:00+00:00"
        ],
        3 => [
            "registration" => "D-AAD",
            "from" => "MAD",
            "to" => "SAR",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T04:30:00+00:00"
        ],
        4 => [
            "registration" => "D-AAE",
            "from" => "MAD",
            "to" => "LJU",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T05:30:00+00:00"
        ],

    ];
    private const EXPECTED_DATA = [
        2 => [
            "registration" => "D-AAC",
            "from" => "MAD",
            "to" => "PDG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T03:30:00+00:00",
            'actual_duration' => 300
        ],
        3 => [
            "registration" => "D-AAD",
            "from" => "MAD",
            "to" => "SAR",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T04:30:00+00:00",
            'actual_duration' => 360
        ],
        4 => [
            "registration" => "D-AAE",
            "from" => "MAD",
            "to" => "LJU",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-11-30T22:30:00+00:00",
            "actual_end" => "2021-12-01T05:30:00+00:00",
            'actual_duration' => 420
        ],

    ];

    public function testThreeLongestFlights(): void
    {
        $this->assertSame(self::EXPECTED_DATA, CalculateThreeLongestFlights::calculate(self::INPUT_DATA));
    }
}
