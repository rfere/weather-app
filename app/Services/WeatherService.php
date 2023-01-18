<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public static function toCelsius($kelvin)
    {
        return round($kelvin - 273.15);
    }

    public static function toFahrenheit($kelvin)
    {
        return round(1.8 * ($kelvin - 273.15) + 32);
    }

    public static function getTemperature($latitude, $longitude)
    {
        $key = env('OPEN_WEATHER_KEY');
        $endpoint = env('OPEN_WEATHER_API');

        $response = Http::get($endpoint, [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => $key,
        ]);

        if ($response->status() != 200) {
            return false;
        }

        return $response['main']['temp'];
    }

    public static function getAdvice($celsius) {
        if ($celsius < 5) {
            return "Please wear gloves, it's cold!";
        } elseif ($celsius > 20) {
            return "Please wear shorts, it's hot!";
        } else {
            return "Please wear whatever you like.";
        }
    }
}