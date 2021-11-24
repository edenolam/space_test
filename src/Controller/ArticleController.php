<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * Currently unused: just showing a controller with a constructor!
     */

    /**
     * @param ArticleRepository $repository
     * @return Response
     * @Route ("/", name="app_homepage")
     * @throws QueryException
     */
    public function homepage(ArticleRepository $repository): Response
    {
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @param Article $article
     * @return Response
     * @Route ("/article/{slug}", name="article_show"))
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);

    }

    /**
     * @Route ("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"}))
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em): JsonResponse
    {
        $article->incrementHeartCount();
        $em->flush();
        $logger->info('Article is being hearted!');
        return $this->json(['hearts' => $article->getHeartCount()]);
    }

}