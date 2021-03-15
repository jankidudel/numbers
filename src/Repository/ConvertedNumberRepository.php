<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ConvertedNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConvertedNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConvertedNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConvertedNumber[]    findAll()
 * @method ConvertedNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvertedNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConvertedNumber::class);
    }

    public function findRecent(int $count = 10)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults($count)
            ->getQuery();
        return $query->getArrayResult();
    }

    public function findTopConverted(int $count = 10)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c as item')
            ->addSelect('COUNT(c.id) as  count')
            ->orderBy('count', 'DESC')
            ->groupBy('c.original')
            ->setMaxResults($count)
            ->getQuery();


        $res = $query->getArrayResult();

        return $res;
    }

    public function save(ConvertedNumber $convertedNumber)
    {
        $em = $this->getEntityManager();
        $em->persist($convertedNumber);
        $em->flush();
    }
}
