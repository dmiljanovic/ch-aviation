<?php namespace App\Factory;


use App\Domain\Airline;
use App\Domain\Airplane;
use App\Domain\Flight;
use App\Infrastructure\AirlineLookup;
use DateTimeImmutable;
use Exception;

class FlightFactory
{
    private array $args;

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * @throws Exception
     */
    public function make(): Flight
    {
        return new Flight(
            $this->getArg('registration'),
            $this->getArg('from'),
            $this->getArg('to'),
            $this->getArg('scheduled_start'),
            $this->getArg('scheduled_end'),
            $this->getArg('actual_start'),
            $this->getArg('actual_end')
        );
    }

    /**
     * @throws Exception
     */
    private function getArg(string $key): Airplane|DateTimeImmutable|string
    {
        if (isset($this->args[$key])) {
            switch ($key) {
                case 'registration':
                    $registration = $this->args[$key];
                    $airline = new Airline(AirlineLookup::from($registration));

                    return new Airplane($registration, $airline);
                case 'scheduled_start':
                case 'scheduled_end':
                case 'actual_start':
                case 'actual_end':
                    return new DateTimeImmutable($this->args[$key]);
                default:
                    return trim($this->args[$key]);
            }
        }

        return '';
    }
}
