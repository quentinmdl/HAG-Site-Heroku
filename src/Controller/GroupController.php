<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    #[Route('/profil/groupe', name: 'app_user_group')]
    public function index(): Response
    {
        return $this->render('user/group/profileGroup.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }
}
