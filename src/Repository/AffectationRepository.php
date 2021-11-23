<?php

namespace App\Repository;

use App\Entity\Affectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affectation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affectation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affectation[]    findAll()
 * @method Affectation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affectation::class);
    }

    /**
     * @param string|null $term
     * @return Affectation[] Returns an array of Affectation objects
     */
    public function findAllWithSearch(?string $term): array
    {
        $qb = $this->createQueryBuilder('a');
        if ($term) {
            $qb
                ->andWhere('a.evaluate LIKE :term OR a.evaluator LIKE :term')
                ->setParameter('term', '%' . $term . '%');
        }
        return $qb
            ->orderBy('a.evaluate', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string|null $term
     * @return Affectation[] Returns an array of Affectation objects
     */

    public function findByEvaluate(?string $term): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.evaluate LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery()
            ->getResult()
            ;
    }

     /**
      * @param string|null $term
      * @return Affectation[] Returns an array of Affectation objects
      */

    public function findByEvaluator(?string $term): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.evaluator LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery()
            ->getResult()
        ;
    }

}
