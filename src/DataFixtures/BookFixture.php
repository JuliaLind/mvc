<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

/**
 * Fixture for testing Library
 */
class BookFixture extends Fixture
{
    /**
     * Adds three entites of class Book to
     * the test database
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $book = new Book();
            $book->setTitle("Book {$i}");
            $book->setIsbn("012345678901{$i}");
            $book->setAuthor("Author {$i}");
            $book->setImg("https://imglink{$i}.com");
            $manager->persist($book);
        }

        $manager->flush();
    }
}
