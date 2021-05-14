<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
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
    public function create(User $user = null, Group $group = null, Request $request, ObjectManager $manager): Response
    {
        $group = new Group();
        $user = $this->getUser();

        $createGroupForm = $this->createForm(GroupType::class, $group);
        $createGroupForm->handleRequest($request);

        if ($createGroupForm->isSubmitted() && $createGroupForm->isValid()) {
            $group->setOwner($user->getUsername());
            $user->setGroups($group);
            $group->setCreatedAt(new \DateTime('Europe/Monaco'));
            $manager->persist($group);
            $manager->flush();

            $this->addFlash(
                'success',
                'Groupe crée avec succès !'
            );
            return $this->redirectToRoute('app_show_group');
        }

        
        return $this->render('user/group/createGroup.html.twig', [
            'create_group_form' => $createGroupForm->createView()
        ]);
    }


    #[Route('/profil/groupe', name: 'app_show_group')]
    public function show(User $user, Group $group, GroupRepository $repo): Response
    {
        $groupid = $group->getId();
        $userGroupList = $repo->SelectUserId($groupid);

        return $this->render('user/group/profileGroup.html.twig', [
            'group' => $userGroupList,
            'controller_name' => 'GroupController'
        ]);
    }
}
