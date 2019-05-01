<?php

namespace App\Weather;

use App\ExternalApi\WeatherApiInterface;

class WeatherProviderManager
{
    /** @var WeatherApiInterface[] */
    private $weatherProvider;

    /**
     * @param \DateTime $day
     * @return WeatherApiInterface
     * @throws \Exception
     */
    public function getWeatherProvider(\DateTime $day): WeatherApiInterface
    {
        $weekday = $day->format('D');
        if ($weekday === 'Sat' || $weekday === 'Sun') {
            $service = $this->getProviderService('yahoo');
        } else {
            $service = $this->getProviderService('google');
        }
        return $service;
    }

    /**
     * @param string              $providerName
     * @param WeatherApiInterface $weatherApiService
     */
    public function addWeatherProvider($providerName, WeatherApiInterface $weatherApiService): void
    {
        $this->weatherProvider[$providerName] = $weatherApiService;
    }

    /**
     * @param $providerServiceName
     * @return WeatherApiInterface
     * @throws \Exception
     */
    private function getProviderService($providerServiceName): WeatherApiInterface
    {
        if (!isset($this->weatherProvider[$providerServiceName])) {
            throw new \RuntimeException('Provider with name: "' . $providerServiceName . 'does not exit');
        }
        return $this->weatherProvider[$providerServiceName];
    }
}
