<?php

namespace App\Helpers;

use Datetime;

use PHPUnit\Framework\TestCase;

/**
 * To mock the builtin random function.
 * Even though the params are not used
 * they are needed to resemble the "mocked" function
 * @scrutinizer ignore-unused
 * @SuppressWarnings(PHPMD)
 */
function random_int(int $min, int $max): int
{
    return 4;
}


/**
 * Test cases for class JsonHandler.
 */
class JsonHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $handler = new JsonHandler();
        $this->assertInstanceOf("\App\Helpers\JsonHandler", $handler);
    }

    /**
     * Tests that getLandingData method returns correct data
     */
    public function testGetLandingData(): void
    {
        $handler = new JsonHandler();
        $exp = [
            'page' => "landing",
            'url' => "/api",
            'jsonRoutes' => [
                [
                    'link' => "quote",
                    'descr' => "Displays a motivational quote and date and time the site was rendered",
                    'method' => '',
                    'route' => '/api/quote'
                ],
                [
                    'link' => "jsonDeck",
                    'descr' => "Displays a json-text representation of all cards in deck sorted by color and value",
                    'method' => '',
                    'route' => '/api/deck'
                ],
                [
                    'link' => "jsonShuffle",
                    'descr' => "Post route that returnes a shuffled json-text representation of all cards in deck",
                    'method' => 'POST',
                    'route' => '/api/deck/shuffle'
                ],
                [
                    'link' => "jsonDraw",
                    'descr' => "Post route that 'draws' and displays the top-card from deck and also the count of cards remaining",
                    'method' => 'POST',
                    'route' => '/api/deck/draw'
                ],
                [
                    'link' => "jsonDrawMany",
                    'descr' => "Post route that 'draws' and displays a number of cards from deck top and also the count of cards remaining",
                    'method' => 'POST',
                    'route' => '/api/deck/draw/5'
                ],
                [
                    'link' => "jsonDeal",
                    'descr' => "Post route that 'draws' and displays a number of cards for a number of players and also the count of cards remaining",
                    'method' => 'POST',
                    'route' => '/api/deck/deal/3/5'
                ],
                [
                    'link' => "jsonGame",
                    'descr' => "Shows current status of game 21",
                    'method' => 'GET',
                    'route' => '/api/game'
                ],
                [
                    'link' => "books_json",
                    'descr' => "Shows all books in the library",
                    'method' => '',
                    'route' => '/api/library/books'
                ],
                [
                    'link' => "single_book_json",
                    'descr' => "Shows one book in the library",
                    'method' => '',
                    'route' => '/api/library/book/9781492053514'
                ],
            ]
        ];
        $res = $handler->getLandingData();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that generateQuote method returns
     * expected Data
     */
    public function testGenerateQuote(): void
    {
        $handler = new JsonHandler();
        $mockedDate = new DateTime();
        $handler->generateQuote($mockedDate);
        $exp = [
            'quote' => <<<EOD
            "Any fool can write code that a computer can understand. 
            Good programmers write code that humans can understand." — Martin Fowler
            EOD,
            'timestamp' => $mockedDate->format('Y-m-d H:i:s'),
        ];
        $res = $handler->generateQuote();
        $this->assertEquals($exp, $res);
    }



}
