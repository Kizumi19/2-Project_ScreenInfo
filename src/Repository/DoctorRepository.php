<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Doctor>
 *
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

//    /**
//     * @return Doctor[] Returns an array of Doctor objects
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

//    public function findOneBySomeField($value): ?Doctor
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getAllSchedules()
    {
        $qb = $this->createQueryBuilder('d')
            ->leftJoin('d.schedules', 's')
            ->addSelect('s')
            ->getQuery();

        return $qb->getResult();
    }

    public function findByPageAndName($page = 1, $pageSize = 10, $name = '')
    {
        $queryBuilder = $this->createQueryBuilder('d');

        if (!empty($name)) {
            $queryBuilder->andWhere('d.name LIKE :name')
                ->setParameter('name', '%' . $name . '%');
        }

        $queryBuilder->setFirstResult(($page - 1) * $pageSize)
            ->setMaxResults($pageSize);

        return $queryBuilder->getQuery()->getResult();
    }

    // En DoctorRepository.php

    public function findBySearchTerm($searchTerm)
    {
        return $this->createQueryBuilder('d')
            ->where('d.name LIKE :searchTerm OR d.surname LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    }


}
