<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupController extends AbstractController
{
    #[Route('/profil/groupe', name: 'app_user_group')]
    public function index(): Response
    {
        return $this->render('user/group/profileGroup.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }

    #[Route('/profil/groupe/création', name: 'app_create_group')]
    public function create(Group $group = null, Request $request, ObjectManager $manager): Response
    {
        $group = new Group();
        $createGroupForm = $this->createForm(GroupType::class, $group);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $createGroupForm->handleRequest($request);

        if ($createGroupForm->isSubmitted() && $createGroupForm->isValid()) {
            $group->setOwner($user->getUsername());
            $group->setCreatedAt(new \DateTime('Europe/Monaco'));
            $manager->persist($group);
            $manager->flush();

            return $this->redirectToRoute('app_user_group');
        }
        return $this->render('user/group/createGroup.html.twig', [
            'create_group_form' => $createGroupForm->createView()
        ]);
    }


    #[Route('/profil/groupe/', name: 'app_show_group')]
    public function show(): Response
    {
        return $this->render('user/group/showGroup.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }
}
