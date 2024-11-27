<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use Exception;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    protected OpenWeatherService $openWeatherService;

    public function __construct(OpenWeatherService $openWeatherService)
    {
        $this->openWeatherService = $openWeatherService;
    }

    /**
     * @throws Exception
     */
    public function show(string $city)
    {
        $validator = Validator::make(['city' => $city], [
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        [$lat, $lon] = $this->openWeatherService->getCityCoordinates($city);
        $weatherConditions = $this->openWeatherService->getWeatherConditions($lat, $lon);

        return response()->json($weatherConditions, 200);
    }
}
