<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }
}
