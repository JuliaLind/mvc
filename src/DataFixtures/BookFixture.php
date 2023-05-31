<?php

namespace App\DataFixtures;

use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

#[CodeCoverageIgnore]
class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

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
