<?php

namespace App\Helpers;

require __DIR__ . "/../../vendor/autoload.php";

use Datetime;

/**
 * Helper class to handle the routes in JsonController
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
                ],
                [
                    'link' => "jsonDeck",
                    'descr' => "Displays a json-text representation of all cards in deck sorted by color and value",
                    'method' => '',
                ],
                [
                    'link' => "jsonShuffle",
                    'descr' => "Post route that returnes a shuffled json-text representation of all cards in deck",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDraw",
                    'descr' => "Post route that 'draws' and displays the top-card from deck and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDrawMany",
                    'descr' => "Post route that 'draws' and displays a number of cards from deck top and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDeal",
                    'descr' => "Post route that 'draws' and displays a number of cards for a number of players and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonGame",
                    'descr' => "Shows current status of game 21",
                    'method' => 'GET',
                ],
                [
                    'link' => "books_json",
                    'descr' => "Shows all books in the library",
                    'method' => '',
                ],
                [
                    'link' => "single_book_json",
                    'descr' => "Shows one book in the library",
                    'method' => '',
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
            "Any fool can write code that a computer can understand. 
            Good programmers write code that humans can understand." — Martin Fowler
            EOD,
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
            EOD
        ];

        $number = random_int(0, count($quotes)-1);
        return [
            'quote' => $quotes[$number],
            'timestamp' => $time->format('Y-m-d H:i:s'),
        ];
    }


}
