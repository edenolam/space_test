<?php

namespace App\Entity;

use App\Repository\AffectationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AffectationRepository::class)
 */
class Affectation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $evaluate;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $evaluator;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEvaluate()
    {
        return $this->evaluate;
    }

    /**
     * @param mixed $evaluate
     */
    public function setEvaluate($evaluate): void
    {
        $this->evaluate = $evaluate;
    }

    /**
     * @return mixed
     */
    public function getEvaluator()
    {
        return $this->evaluator;
    }

    /**
     * @param mixed $evaluator
     */
    public function setEvaluator($evaluator): void
    {
        $this->evaluator = $evaluator;
    }





}
