<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Session;
use App\Entity\Category;
use App\Entity\Challenge;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ArticleCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminDashboardController extends AbstractDashboardController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AHAG');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Accueil', 'fas fa-window-maximize', 'main');
        yield MenuItem::linktoDashboard('Administration', 'fa fa-home');
        yield MenuItem::section('Communication');
        yield MenuItem::linkToCrud('Article(s)', 'fas fa-file-pdf', Article::class);
        yield MenuItem::linkToCrud('Categorie(s)', 'fas fa-file-word', Category::class);
        yield MenuItem::linkToCrud('Commentaire(s)', 'fas fa-comments', Comment::class);

        yield MenuItem::section('Jeu');
        yield MenuItem::linkToCrud('Session', 'fas fa-hands-helping', Session::class);
        yield MenuItem::linkToCrud('Groupe(s)', 'fas fa-user-friends', Group::class);
        yield MenuItem::linkToCrud('Défi(s)', 'fas fa-gamepad', Challenge::class);

        yield MenuItem::section('Comptes');
        yield MenuItem::linkToCrud('Utilisateur(s)', 'fas fa-user', User::class);

        yield MenuItem::section('Paiement');
        yield MenuItem::linkToUrl('Vente(s)', 'fa fa-credit-card', 'https://dashboard.stripe.com/test/dashboard');
    }
}
