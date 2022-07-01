<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyController extends AbstractController
{
    /**
     * @Route("/Privacy", name="Privacy")
     */
    public function Privacy(): Response
    {
        return $this->render('privacy/index.html.twig', [
            'controller_name' => 'PrivacyController',
        ]);
    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function index(): Response
    {
        return $this->render('privacy/index.html.twig', [
            'controller_name' => 'PrivacyController',
        ]);
    }
}
