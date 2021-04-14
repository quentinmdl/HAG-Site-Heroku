<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\CategoryType;
use App\Form\RemoveCategoryType;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index(ArticleRepository $repo, Request $request, PaginatorInterface $paginator): Response
    {
        $articles = $repo->findBy([], ['createdAt' => 'desc']);

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            4
        );

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
            if (!$category) {
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


        if (!$article) {
            $article = new Article();
        }
        $form =  $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            } else {
                $article->setUpdatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article a bien été créé !"
            );

            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $comment->setAuthor($user->getUsername());
            $comment->setCreatedAt(new \DateTime('Europe/Monaco'))
                    ->setArticle($article);
                        
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }    


    #[Route('article/supprimer/{id}', name: 'article_delete')]
    public function delete($id,Article $article,Request $request, ObjectManager $manager): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article a bien été supprimée !"
        );

        return $this->redirectToRoute('articles');


        return $this->render('article/create.html.twig', [
            'editMode' => $article->getId() !== null
        ]);

    }
}
