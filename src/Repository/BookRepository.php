<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Library\BookNotFoundException;
use App\Library\IsbnAlreadyInUseException;

/**
 * @extends ServiceEntityRepository<Book>
 * @SuppressWarnings(PHPMD)
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $entity, bool $flush = false): void
    {
        /**
         * @var string $isbn
         */
        $isbn = $entity->getIsbn();
        try {
            $book = $this->findOneByIsbn($isbn);
            if ($book->getId() !== $entity->getId()) {
                throw new IsbnAlreadyInUseException();
            }
        } catch (BookNotFoundException) {
        }
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function findOneByIsbn(string $isbn): Book
   {
       /**
        * @var Book $book
        */
       $book = $this->createQueryBuilder('b')
          ->andWhere('b.isbn = :val')
          ->setParameter('val', $isbn)
          ->getQuery()
          ->getOneOrNullResult()
       ;
       if (!is_a($book, "App\Entity\Book")) {
           throw new BookNotFoundException();
       }
       return $book;
   }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
