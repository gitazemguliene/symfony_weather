<?php

namespace App\Controller;

use App\ExternalApi\GoogleApi;
use App\Model\NullWeather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    public function index(): Response
    {
        try {
            $service = new GoogleApi();
            $weather = $service->getToday();
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'weatherData'     => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ]
        ]);
    }
}
