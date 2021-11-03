<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @return Response
     * @Route ("/", name="homepage")
     */
    public function homepage(): Response
    {
       return $this->render('article/home.html.twig');
    }

    /**
     * @param $expression
     * @return Response
     * @Route ("/news/{expression}", name="show")
 */
    public function show($expression): Response
    {
        $comments = [
            "Since 1998, SensioLabs has been promoting the Open-Source software movement by providing quality and performant web application development products, trainings, and consulting. SensioLabs also supports multiple important Open-Source projects.",
            "Since 1998, SensioLabs has been promoting the Open-Source software movement by providing quality and performant web application development products, trainings, and consulting. SensioLabs also supports multiple important Open-Source projects.",
            "Since 1998, SensioLabs has been promoting the Open-Source software movement by providing quality and performant web application development products, trainings, and consulting. SensioLabs also supports multiple important Open-Source projects."

        ];
        return $this->render('article/show.html.twig', [
            'expression' => $expression,
            'comments' => $comments
        ]);
    }

}