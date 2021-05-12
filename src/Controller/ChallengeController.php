<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Repository\ChallengeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChallengeController extends AbstractController
{
    #[Route('/challenge', name: 'challenges')]
    public function index(): Response
    {
        return $this->render('challenge/index.html.twig', [
            'controller_name' => 'ChallengeController',
        ]);
    }

    #[Route('/profil/session-défis', name: 'app_user_session_challenges')]
    public function sessionChallengesProfile(ChallengeRepository $repo, Request $request, PaginatorInterface $paginator): Response
    {
        $challenges = $repo->findBy([], ['createdAt' => 'desc']);

        $challenges = $paginator->paginate(
            $challenges,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('user/session/profileSession.html.twig', [
            'controller_name' => 'ChallengeController',
            'challenges' => $challenges
        ]);
    }

    #[Route('/profil/session/défi/{slug}', name: 'app_user_session_challenge_show')]
    public function sessionChallenge(Challenge $challenge, ChallengeRepository $repo, Request $request, PaginatorInterface $paginator): Response
    {
        return $this->render('user/session/challenge/show.html.twig', [
            'controller_name' => 'ChallengeController',
            'challenge' => $challenge
        ]);
    }
}
