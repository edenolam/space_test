<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @return Response
     * @Route ("/", name="homepage")
     */
    public function homepage(): Response
    {
        return new Response('omg!! fuck!!');
    }

    /**
     * @param $expression
     * @return Response
     * @Route ("/news/{expression}", name="show")
     */
    public function show($expression): Response
    {
        return new Response('incurable ce border de '.$expression);
    }
}