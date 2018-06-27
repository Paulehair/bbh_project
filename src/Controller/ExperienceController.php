<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExperienceController extends Controller
{
    /**
     * @Route("/experience", name="experience")
     */
    public function index()
    {
        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
        ]);
    }
}
