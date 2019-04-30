<?php

namespace App\Weather;

use App\ExternalApi\GoogleApi;
use App\Model\Weather;
use DateTime;
use Exception;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\Cache\Simple\FilesystemCache;

class LoaderService
{
    /** @var GoogleApi */
    private $weatherService;

    /** @var FilesystemCache */
    private $cacheService;

    /**
     * LoaderService constructor.
     * @param GoogleApi       $weatherService
     * @param FilesystemCache $cacheService
     */
    public function __construct(GoogleApi $weatherService, FilesystemCache $cacheService)
    {
        $this->weatherService = $weatherService;
        $this->cacheService = $cacheService;
    }

    /**
     * @param DateTime $day
     * @return Weather
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loadWeatherByDay(DateTime $day): Weather
    {
        $cacheKey = $this->getCacheKey($day);
        if ($this->cacheService->has($cacheKey)) {
            echo 'from cache <br> ';
            $weather = $this->cacheService->get($cacheKey);
        } else {
            echo 'save to cache  <br> ';
            $weather = $this->weatherService->getDay($day);
            $this->cacheService->set($cacheKey, $weather);
        }
        return $weather;
    }
    /**
     * @param DateTime $day
     * @return string
     */
    private function getCacheKey(DateTime $day): string
    {
        return $day->format('Y-m-d');
    }
}

