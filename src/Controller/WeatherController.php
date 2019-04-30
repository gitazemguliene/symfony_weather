<?php

namespace App\Controller;

use App\ExternalApi\GoogleApi;
use App\Model\NullWeather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    public function index(Request $request): Response
    {
        try {
            $service = new GoogleApi();
            $weather = $service->getDay(new \DateTime($request->query->get('day')));
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'weatherData'     => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ]
        ]);
    }
}
