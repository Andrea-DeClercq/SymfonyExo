<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function save(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Contact[] Returns an array of Contact objects
//     */
//    public function findContactById($id): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.id = :id')
//            ->setParameter('id', $id)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Contact
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
     public function findByAgeSup18()
     {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\contact c
            WHERE c.age > 18
            ORDER BY c.age ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }
    public function findByAge($age): ?array 
   {
       return $this->createQueryBuilder('u')
           ->andWhere('u.age = :age')
           ->setParameter('age', $age)
           ->getQuery()
           ->getResult()
       ;
   }
}
