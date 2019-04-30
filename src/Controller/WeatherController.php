<?php

namespace App\Controller;

use App\Model\NullWeather;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends Controller
{
    /**
     *  #https://symfony.com/doc/current/best_practices/controllers.html#fetching-services
     * @param           $day
     * @return Response
     */
    public function index($day): Response
    {
        try {
            $googleApiService = $this->get('app.weather.api_service');
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
