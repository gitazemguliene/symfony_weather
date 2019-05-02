<?php

namespace App\Weather;

use App\ExternalApi\GoogleApi;
use App\Model\Weather;
use DateTime;
use Exception;
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
     * @throws Exception
     */
    public function loadWeatherByDay(DateTime $day): Weather
    {
        return $this->weatherService->getDay($day);
    }
}
