<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonLibraryControllerTest extends WebTestCase
{
    // public function testShowAllBooks(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/api/library/books');
    //     $this->assertResponseIsSuccessful();
    //     $this->assertRouteSame('books_json');
    // }

    // public function testShowABookByIsbnNotOk(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/api/library/book/8589384934');
    //     $this->assertResponseIsSuccessful();
    //     $this->assertRouteSame('single_book_json');
    //     $response = strval($client->getResponse()->getContent());
    //     $this->assertJson($response);
    //     $this->assertStringContainsString("Book with ISBN 8589384934 was not found.", $response);
    // }

    // public function testShowABookByIsbnOk(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/api/library/book/0123456789010');
    //     $this->assertResponseIsSuccessful();
    //     $this->assertRouteSame('single_book_json');
    //     $response = strval($client->getResponse()->getContent());
    //     $this->assertJson($response);
    //     $this->assertStringContainsString("0123456789010", $response);
    // }
}
