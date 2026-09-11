<?php

namespace App\Repository;

use App\Entity\Loan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loan>
 */
class LoanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loan::class);
    }

    //    /**
    //     * @return Loan[] Returns an array of Loan objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Loan
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
public function findRetrasados(): array
{
    return $this->createQueryBuilder('l')
        ->where('l.estado = :estado')
        ->andWhere('l.fechaDevolucionPrevista < :hoy')
        ->setParameter('estado', 'activo')
        ->setParameter('hoy', new \DateTime())
        ->getQuery()
        ->getResult();
}

public function findTopBooks(int $limit): array
{
    return $this->createQueryBuilder('l')
        ->select('b.titulo, COUNT(l.id) as total')
        ->join('l.Book', 'b')
        ->groupBy('b.id')
        ->orderBy('total', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}}
