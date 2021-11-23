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
        $evaluator = $request->query->get('evaluator');
        $evaluate = $request->query->get('evaluate');
        return $this->render('affectation/index.html.twig', [
            'affectations' => $repository->findAllWithSearch($q),
            'evaluators' => $repository->findByEvaluator($evaluator),
            'evaluates' => $repository->findByEvaluate($evaluate),
        ]);
    }
}
