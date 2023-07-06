<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
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

    public function compareId(Book $book, Book $otherBook): void
    {
        $bookId = $book->getId();
        $otherBookId = $otherBook->getId();

        if ($bookId !== $otherBookId) {
            throw new IsbnAlreadyInUseException();
        }
    }

    public function saveToDB(bool $flush): void
    {
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Book $entity, bool $flush = false): void
    {
        /**
         * @var string $isbn
         */
        $isbn = $entity->getIsbn();
        try {
            $book = $this->findOneByIsbn($isbn);
            $this->compareId($book, $entity);
        } catch (BookNotFoundException) {
            /**
             * If exception is raised it means no ther book
             * exists with same ISBN. Same goes for if the
             * exception is not raised but the found book is the
             * same one that is being updated
             */

        }
        $this->getEntityManager()->persist($entity);
        $this->saveToDB($flush);
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        $this->saveToDB($flush);
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
