<?php

namespace App\Controller;

use App\ExternalApi\GoogleApi;
use App\Model\NullWeather;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    /** @var GoogleApi */
    private $googleApi;

    /**
     * WeatherController constructor.
     * @param GoogleApi $googleApi
     */
    public function __construct(GoogleApi $googleApi)
    {
        $this->googleApi = $googleApi;
    }

    /**
     * @param           $day
     * @return Response
     */
    public function index($day): Response
    {
        try {
            $weather = $this->googleApi->getDay(new DateTime($day));
        } catch (Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'weatherData' => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ],
        ]);
    }
}
