<?php

namespace App\Helpers;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to get data for the lucky route
 */
class LuckyRouteData
{
    /**
     * @return array<string,string>
     */
    public function luckyData(): array
    {
        $top = random_int(3, 25);
        $left = random_int(1, 80);

        $monkey = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: {$left}%; margin-top: {$top}%;" alt="apa">
        EOD;

        return [
            'page' => "lucky",
            'monkey' => $monkey,
            'url' => "/lucky",
        ];
    }
}
