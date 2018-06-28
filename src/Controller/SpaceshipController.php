<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SpaceshipController extends Controller
{
    /**
     * @Route("/spaceship", name="spaceship")
     */
    public function index()
    {
        return $this->render('spaceship/index.html.twig', [
            'controller_name' => 'SpaceshipController',
        ]);
    }
}
