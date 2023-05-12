<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle the landing routes in CardController
 */
class CardLandingHandler
{
    /**
     * @return array<string,array<int,array<string,string>>|string>
     */
    public function getMainData()
    {
        return [
            'page' => "landing",
            'url' => "/card",
            'cardRoutes' => [
                [
                    'link' => "deck",
                    'method' => 'GET',
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                ],
            ],
        ];
    }
}
