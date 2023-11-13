<?php

namespace App\Infrastructure;

use App\Domain\Airline;
use App\Domain\Airplane;
use App\Domain\Flight;
use Rs\JsonLines\JsonLines;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'parse')]
class ParseCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flightsJson = (new JsonLines())->delineFromFile('var/input.jsonl');
        $flights = json_decode($flightsJson, true);

        $output->writeln('Start calculating three longest flights...');
        var_dump(CalculateThreeLongestFlights::calculate($flights));
        $output->writeln('Calculate ended.');

        $output->writeln('Start calculating most missed landings...');
        var_dump(CalculateMostMissedScheduledLandings::calculate($flights));
        $output->writeln('Calculate ended.');

        $output->writeln('Start calculating destination overnight stays...');
        var_dump(CalculateDestinationOvernightStays::calculate($flights));
        $output->writeln('Calculate ended.');

        return Command::SUCCESS;
    }
}