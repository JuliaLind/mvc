<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibraryController2Test extends WebTestCase
{
    public function testUpdateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/update/0123456789010');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('update_form');
        $this->assertSelectorTextContains('h1', "Uppdatera bokdetaljer för 'Book 0'");
    }

    public function testUpdateOk(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123456789010',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/read_one/0123456789010');
    }

    public function testUpdateAnotherOk(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123459999010',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/read_one/0123459999010');
    }

    public function testUpdateNotOk(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123456789011',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/update/0123456789010');
    }
}
