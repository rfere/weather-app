<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\WeatherService;

class TemperatureTest extends TestCase
{
    public function test_celsius_conversion()
    {
        $this->assertEquals(20, WeatherService::toCelsius(293.15));
    }

    public function test_fahrenheit_conversion()
    {
        $this->assertEquals(20, WeatherService::toFahrenheit(266.483));
    }

    public function test_advice_wear_gloves_when_below_five_celsius()
    {
        $this->assertEquals("Please wear gloves, it's cold!", WeatherService::getAdvice(4));
    }

    public function test_advice_wear_shorts_when_over_twenty_celsius()
    {
        $this->assertEquals("Please wear shorts, it's hot!", WeatherService::getAdvice(21));
    }

    public function test_advice_wear_whatever_between_five_and_twenty()
    {
        $this->assertEquals("Please wear whatever you like.", WeatherService::getAdvice(10));
    }
}
