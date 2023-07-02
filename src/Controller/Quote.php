<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Datetime;

/**
 * Helper class to get data for for the API Quote route
 */
class Quote
{
    /**
     * Returns a daily quote and the date, time when the page was loaded
     * @return array<string>
     */
    public function generate(
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
