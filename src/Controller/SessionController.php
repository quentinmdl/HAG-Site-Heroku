<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/jouer', name: 'play')]
    public function index(SessionRepository $repo): Response
    {
        $sessions = $repo->findBy([], ['createdAt' => 'desc']);
        
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
            'sessions' => $sessions
        ]);
    }


    #[Route('/session/{slug}', name: 'play_show')]
    public function show(Session $session, SessionRepository $repo, Request $request): Response
    {
        return $this->render('session/show.html.twig', [
            'controller_name' => 'SessionController',
            'session' => $session
        ]);
    }


    #[Route('/session-participer', name: 'checkout')]
    public function checkout(): Response
    {
        \Stripe\Stripe::setApiKey('sk_test_51Ihi1LDDEk7YAvTO3EgKhutLS0TJZCzBj3gDr8XRufxH7Uu2twa6GJgkxodbc6MV4G5hqaxjQsYqHmcSBgRdzl9R000Fh2Hjxr');
        
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => "Session Actuelle",
                ],
                'unit_amount' => 4000,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('checkout_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('checkout_error', [], UrlGeneratorInterface::ABSOLUTE_URL),
          ]);
        
        return new JsonResponse([ 'id' => $session->id ]);
    }


    #[Route('/session-vérification/erreur', name: 'checkout_error')]
    public function error(): Response
    {
        return $this->render('session/payment/error.html.twig', [
        ]);
    }

    #[Route('/session-vérification/succès', name: 'checkout_success')]
    public function success(): Response
    {
        return $this->render('session/payment/success.html.twig', [
        ]);
    }
}
