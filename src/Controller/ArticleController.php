<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\CategoryType;
use App\Form\SearchArticleType;

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
        $searchArticleForm = $this->createForm(SearchArticleType::class);
        if ($searchArticleForm->handleRequest($request)->isSubmitted() && $searchArticleForm->isValid()) {
            $searchData = $searchArticleForm->getData();
            $articles = $repo->findByCategory($searchData);
        } else {
            $articles = $repo->findBy([], ['createdAt' => 'desc']);
        }

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            4
        );
    
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'search_article_form' => $searchArticleForm->createView(),
            'articles' => $articles
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
}
