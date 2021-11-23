<?php

namespace App\Controller;

use App\Repository\AffectationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffectationController extends AbstractController
{
    /**
     * @Route("/affectation", name="affectation")
     */
    public function index(AffectationRepository $repository, Request $request): Response
    {
        $q = $request->query->get('q');
        $evlr = $request->query->get('evlr');
        $evlt = $request->query->get('evlt');
        return $this->render('affectation/index.html.twig', [
            'affectations' => $repository->findAllWithSearch($q),
            'evaluators' => $repository->findByEvaluator($evlr),
            'evaluates' => $repository->findByEvaluate($evlt),
        ]);
    }
}
