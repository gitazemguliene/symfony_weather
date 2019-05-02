<?php

namespace App\Weather;

use App\ExternalApi\GoogleApi;
use App\Model\Weather;
use DateTime;
use Exception;

class LoaderService
{
    /** @var GoogleApi */
    private $weatherService;

    /**
     * LoaderService constructor.
     * @param GoogleApi $weatherService
     */
    public function __construct(GoogleApi $weatherService)
    {
        $this->weatherService = $weatherService;
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
