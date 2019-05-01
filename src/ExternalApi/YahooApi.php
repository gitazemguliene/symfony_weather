<?php

namespace App\ExternalApi;

class YahooApi extends AbstractWeatherService implements WeatherApiInterface
{
    public const PROVIDER_NAME = 'Yahoo';
}
