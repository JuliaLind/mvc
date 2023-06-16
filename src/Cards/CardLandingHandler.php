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
                    'route' => '/card/deck'
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                    'route' => '/card/deck/shuffle'
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                    'route' => '/card/deck/draw'
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                    'route' => '/card/deck/draw/5'
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                    'route' => '/card/deck/deal/3/5'
                ],
            ],
        ];
    }
}
