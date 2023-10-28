<?php

namespace App\Repository;

use App\Entity\DoctorSpeciality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DoctorSpeciality>
 *
 * @method DoctorSpeciality|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctorSpeciality|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctorSpeciality[]    findAll()
 * @method DoctorSpeciality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorSpecialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctorSpeciality::class);
    }

//    /**
//     * @return DoctorSpeciality[] Returns an array of DoctorSpeciality objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DoctorSpeciality
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
