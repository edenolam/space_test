<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController
{
    /**
     * @return Response
     * @Route ("/infoenv", name="infoenv")
     */
    public function pageInfo(): Response
    {
        return new Response(phpinfo());
    }
}