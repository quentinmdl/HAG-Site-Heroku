<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/jouer', name: 'play')]
    public function index(SessionRepository $repo): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }


    #[Route('/session', name: 'play_show')]
    public function show(SessionRepository $repo, Request $request): Response
    {
        $session = $repo->findOneBy([], ['id' => 'desc']);

        return $this->render('session/show.html.twig', [
            'controller_name' => 'SessionController',
            'session' => $session
        ]);
    }
}
