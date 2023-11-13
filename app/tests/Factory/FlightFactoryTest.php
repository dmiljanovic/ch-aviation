<?php

namespace App\Tests\Factory;

use App\Domain\Flight;
use App\Factory\FlightFactory;
use Exception;
use PHPUnit\Framework\TestCase;

class FlightFactoryTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreatingFlightObject(): void
    {
        $factory = new FlightFactory([
            'registration' => 'OO-AAC',
            'from' => 'STN',
            'to' => 'BER',
            'scheduled_start' => '2021-12-17T10:00:00+00:00',
            'scheduled_end' => '2021-12-17T11:30:00+00:0',
            'actual_start' => '2021-12-17T10:12:00+00:00',
            'actual_end' => '2021-12-17T11:33:00+00:00',
        ]);

        $flight = $factory->make();

        $this->assertInstanceOf(Flight::class, $flight);
    }
}
