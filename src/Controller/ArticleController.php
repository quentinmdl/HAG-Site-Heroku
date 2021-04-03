<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index(ArticleRepository $repo): Response
    {
    
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }

    #[Route('/article/nouveau', name: 'article_create')]
    #[Route('/article/{id}/edit', name: 'article_edit')]
    public function form(Article $article = null, Request $request, ObjectManager $manager): Response
    {
        if(!$article) {
            $article = new Article();
        }
        $form =  $this->createForm(ArticleType::class, $article);
                    

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()) { 
                $article->setCreatedAt(new \DateTime());
            }else {
                $article->setUpdatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article_show', ['id' => $article->getId()] );
        }
        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }


     #[Route('/article/{id}', name: 'article_show')]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }       
}
