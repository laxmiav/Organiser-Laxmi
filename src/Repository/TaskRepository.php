<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Task $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Task $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Task[] Returns an array of Task objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    
    public function findAllByprocess($process)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a 
            FROM App\Entity\Task a
           
            
            WHERE a.process like :process'
             
        )->setParameter('process', $process);
     

        return $query->getResult();

    }  


   
    public function findAllByCategory($process,int $id)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a 
            FROM App\Entity\Task a
            JOIN a.category u
           
            
            WHERE a.process like :process AND  u.id = :id'
             
             )
             ->setParameter('process', $process)
             ->setParameter('id', $id);
          


        return $query->getResult();

    } 

    public function findAllByPriority($process,string $priority)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a 
            FROM App\Entity\Task a
            JOIN a.category u
           
            
            WHERE a.process like :process AND a.status like :priority'
             
             )
             ->setParameter('process', $process)
             
             ->setParameter('priority', $priority);
          


        return $query->getResult();

    } 
}
