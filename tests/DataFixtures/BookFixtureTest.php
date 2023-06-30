<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use App\Entity\Book;

class BookFixtureTest extends TestCase
{
    public function testLoad(): void
    {
        $books = [];
        for ($i = 0; $i < 3; $i++) {
            $book = new Book();
            $book->setTitle("Book {$i}");
            $book->setIsbn("012345678901{$i}");
            $book->setAuthor("Author {$i}");
            $book->setImg("https://imglink{$i}.com");
            $books[$i] = $book;
        }

        $fixture = new BookFixture();
        $manager = $this->createMock(ObjectManager::class);
        $manager->expects($this->exactly(3))
                ->method('persist')
                ->with($this->isInstanceOf(Book::class));
        $manager->expects($this->once())
                ->method('flush');
        $fixture->load($manager);
    }
}
