<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\CategoryType;
use App\Repository\ArticleRepository;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function form(Article $article = null, Category $category = null, Request $request, ObjectManager $manager): Response
    {
       
        $category = new Category();

        $formCategory =  $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            if(!$category) { 
                $category->setTitle();
                $category->setDescription();
            }

            $manager->persist($category);
            $manager->flush();

            $this->addFlash(
                'success',
                'Catégorie créée avec succès !'
            );

            return $this->redirectToRoute('article_create');
        }

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

            $this->addFlash(
                'success',
                "L'article a bien été créé !"
            );

            return $this->redirectToRoute('article_show', ['id' => $article->getId()] );
        }
        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'formCategory' => $formCategory->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }


    #[Route('/article/{id}', name: 'article_show')]
    public function show(Article $article, Comment $comment = null, Request $request, ObjectManager $manager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $user = $this->get('security.token_storage')->getToken()->getUser();

        /** A REVOIR  1 COMMENT PER  USER/ARTICLE */
        $username = $user->getUsername();
        $articleId = $article->getId();
  
  
        $commented = $this->getDoctrine()
                ->getRepository(Article::class)
                ->findAuthorComment($articleId);
  
        /** END */

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($commented === $username) {
                return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
            } else {
                $comment->setAuthor($username);
                $comment->setCreatedAt(new \Datetime())
                        ->setArticle($article);
                        
                $manager->persist($comment);
                $manager->flush();

                return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
            }
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }       
}
