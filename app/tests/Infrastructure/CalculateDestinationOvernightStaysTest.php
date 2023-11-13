<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\CalculateDestinationOvernightStays;
use PHPUnit\Framework\TestCase;

class CalculateDestinationOvernightStaysTest extends TestCase
{
    private const INPUT_DATA = [
        0 => [
            "registration" => "HA-AAA",
            "from" => "MAD",
            "to" => "ZGB",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-01T00:30:00+00:00",
            "actual_end" => "2021-01-02T01:30:00+00:00"
        ],
        1 => [
            "registration" => "HA-AAA",
            "from" => "ZGB",
            "to" => "MAD",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-03T00:30:00+00:00",
            "actual_end" => "2021-01-04T02:30:00+00:00"
        ],
        2 => [
            "registration" => "HA-AAA",
            "from" => "MAD",
            "to" => "PDG",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-05T22:30:00+00:00",
            "actual_end" => "2021-01-06T03:30:00+00:00"
        ],
        3 => [
            "registration" => "H-AAA",
            "from" => "PDG",
            "to" => "MAD",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-07T22:30:00+00:00",
            "actual_end" => "2021-01-08T01:03:00+00:00"
        ],
        4 => [
            "registration" => "H-AAB",
            "from" => "MAD",
            "to" => "LJU",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-09T22:30:00+00:00",
            "actual_end" => "2021-01-10T23:06:00+00:00"
        ],
        5 => [
            "registration" => "H-AAB",
            "from" => "LJU",
            "to" => "BGD",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-11T22:30:00+00:00",
            "actual_end" => "2021-01-12T23:00:00+00:00"
        ],
        6 => [
            "registration" => "H-AAB",
            "from" => "BGD",
            "to" => "SKO",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-13T22:30:00+00:00",
            "actual_end" => "2021-01-14T23:06:00+00:00"
        ],
        7 => [
            "registration" => "H-AAB",
            "from" => "SKO",
            "to" => "SAR",
            "scheduled_start" => "2021-11-30T22:00:00+00:00",
            "scheduled_end" => "2021-12-01T01:00:00+00:00",
            "actual_start" => "2021-01-15T22:30:00+00:00",
            "actual_end" => "2021-01-16T01:00:00+00:00"
        ],

    ];

    private const EXPECTED_DATA = [
        'MAD' =>
            [
                'overnight_stays' => 2
            ],
    ];

    public function testThreeLongestFlights(): void
    {
        $this->assertSame(self::EXPECTED_DATA, CalculateDestinationOvernightStays::calculate(self::INPUT_DATA));
    }
}
