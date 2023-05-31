<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

// use App\Repository\BookRepository;


class LibraryUpdateBookControllerTest extends WebTestCase
{
    public function testUpdateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/update/0123456789010');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('update_form');
        $this->assertSelectorTextContains('h1', "Uppdatera bokdetaljer för 'Book 0'");
    }

    // public function testUpdateOk(): void
    // {
    //     // $kernel = self::bootKernel();

    //     // $book = $repo->findOneByIsbn('0123456789010');
    //     // $id = $book->getId();
    //     $client = static::createClient();
    //     $client->request(
    //         'POST',
    //         '/library/update_one',
    //         [
    //         'book_id' => 7,
    //         'title' => 'Updated Book',
    //         'isbn' => '0123456789010',
    //         'image' => 'https://newimglink.com',
    //         'author' => 'The Author'
    //         ]
    //     );
    //     $this->assertRouteSame('book_update');
    //     $this->assertResponseRedirects('/library/read_one/2345678901234');
    // }
}
