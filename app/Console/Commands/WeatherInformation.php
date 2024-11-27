<?php

namespace App\Console\Commands;

use App\Services\OpenWeatherService;
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
     * @throws \Exception
     */
    public function handle()
    {
        $city = $this->argument('city');

        if (!is_string($city)) {
            throw new InvalidArgumentException('City argument must be a string.');
        }

        $openWeatherService = new OpenWeatherService();
        [$lat, $lon] = $openWeatherService->getCityCoordinates($city);

        $weatherConditions = json_decode($openWeatherService->getWeatherConditions($lat, $lon));

        $this->info("Weather information for " . $weatherConditions->name . ", United Kingdom:");
        $this->line("Current weather conditions: " . $weatherConditions->weather[0]->main . " (" . $weatherConditions->weather[0]->description . ")");
        $this->line("The current temperature: " . round($weatherConditions->main->temp) . "°C");
        $this->line("'Feels like' temperature: " . round($weatherConditions->main->feels_like) . "°C");
        $this->line("Humidity: " . $weatherConditions->main->humidity . "%");
        $this->line("Minimum temperature: " . round($weatherConditions->main->temp_min) . "°C");
        $this->line("Maximum temperature: " . round($weatherConditions->main->temp_max) . "°C");

        // Convert wind speed to mph
        $windSpeedMph = round($weatherConditions->wind->speed * config('openweather.mps_to_mph_ratio'), 1);
        $this->line("Wind speed: " . $windSpeedMph . "mph");

        if (isset($weatherConditions->rain)) {
            $this->line("Rain volume for the last hour: " . $weatherConditions->rain->{'1h'} . "mm");
        }
    }
}
