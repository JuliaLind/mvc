<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Helper class to handle the routes in CardController
 */
class CardDeckHandler
{
    /**
     * Returns an array with data for /card/deck route
     * @return array<string,string|array<string>>
     */
    public function getDeckRouteData(DeckOfCards $deck): array
    {
        $data = [
            'title' => "Sorted deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        return $data;
    }

}
