<?php

namespace App\Helpers;

require __DIR__ . "/../../vendor/autoload.php";

use Datetime;

/**
 * Helper class to get data for some of the API routes
 */
class JsonHandler
{
    /**
     * Returns an array with data json landing page
     * @return  array<string,array<int,array<string,string>>|string>
     */
    public function getLandingData(): array
    {
        return [
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
    }

    /**
     * Returns a daily quote and the date, time when the page was loaded
     * @return array<string>
     */
    public function generateQuote(
        DateTime  $time = new DateTime()
    ): array {
        $quotes = [
            <<<EOD
            "It is never too late to be what you might have been." — George Eliot
            EOD,
            <<<EOD
            "Do the best you can. No one can do more than that.” — John Wooden
            EOD,
            <<<EOD
            "Do what you can, with what you have, where you are." — Theodore Roosevelt
            EOD,
            <<<EOD
            "If you can dream it, you can do it." — Walt Disney
            EOD,
            <<<EOD
            "Any fool can write code that a computer can understand. 
            Good programmers write code that humans can understand." — Martin Fowler
            EOD
        ];

        $number = random_int(0, count($quotes)-1);
        return [
            'quote' => $quotes[$number],
            'timestamp' => $time->format('Y-m-d H:i:s'),
        ];
    }


}
