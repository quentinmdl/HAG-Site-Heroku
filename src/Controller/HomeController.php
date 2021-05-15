<?php

namespace App\Controller;

use App\Entity\Group;
use App\Repository\GroupRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(GroupRepository $repo): Response
    {
        $group = $repo->findBy([], ['score' => 'desc']);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'group' => $group
        ]);
    }
}
