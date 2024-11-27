<?php

namespace App\Services;

use Exception;
use RakibDevs\Weather\Weather;

class OpenWeatherService
{
    protected Weather $weatherAPI;

    public function __construct()
    {
        $this->weatherAPI = new Weather();
    }

    /**
     * @throws Exception
     */
    public function getCityCoordinates($city): array
    {
        $geoData = $this->weatherAPI->getGeoByCity($city . ',GB');

        if (is_array($geoData) && isset($geoData[0]->lat) && isset($geoData[0]->lon)) {
            return [$geoData[0]->lat, $geoData[0]->lon];
        }

        // Could not get valid data
        throw new Exception("Could not get valid geolocation data for {$city}.");
    }

    /**
     * @throws Exception
     */
    public function getWeatherConditions($lat, $lon): string
    {
        $weatherConditions = $this->weatherAPI->getCurrentByCord($lat, $lon);

        if (isset($weatherConditions->cod) && $weatherConditions->cod >= 200 && $weatherConditions->cod < 300) {
            return json_encode($weatherConditions);
        }

        // Could not get valid data
        throw new Exception("Failed to get valid weather conditions.");
    }
}
