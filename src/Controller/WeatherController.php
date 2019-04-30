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
    /**
     * @param           $day
     * @param GoogleApi $googleApiService
     * @return Response
     */
    public function index($day, GoogleApi $googleApiService): Response
    {
        try {
            $weather = $googleApiService->getDay(new DateTime($day));
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
