<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\WeatherService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('weather', [
        'latitude' => session()->get('latitude'),
        'longitude' => session()->get('longitude'),
        'celsius' => session()->get('celsius'),
        'fahrenheit' => session()->get('fahrenheit'),
        'message' => session()->get('message')
    ]);
});

Route::post('/', function(Request $request) {

    $validated = $request->validate([
        'latitude' => ['required', 'numeric'],
        'longitude' => ['required', 'numeric'],
    ]);

    $latitude = $validated['latitude'];
    $longitude = $validated['longitude'];
    $kelvin = WeatherService::getTemperature($latitude, $longitude);

    if ($kelvin == false) {
        return back()->withErrors('Sorry, we could not reach the OpenWeather API');
    }

    $celsius = WeatherService::toCelsius($kelvin);
    $fahrenheit = WeatherService::toFahrenheit($kelvin);
    $advice = WeatherService::getAdvice($celsius);

    return back()->with([
        'latitude' => $latitude,
        'longitude' => $longitude,
        'celsius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'message' => $advice
    ]);
});
