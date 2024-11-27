<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;

class WeatherInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:information {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provide weather information for certain city in the UK.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');

        if (!is_string($city)) {
            throw new InvalidArgumentException('City argument must be a string.');
        }

        // ToDo: further code
    }
}
