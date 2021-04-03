<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeController extends AbstractController
{
    #[Route('/challenge', name: 'challenge')]
    public function index(): Response
    {
        return $this->render('challenge/index.html.twig', [
            'controller_name' => 'ChallengeController',
        ]);
    }
}
