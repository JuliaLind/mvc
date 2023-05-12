<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Helper class to handle the routes in CardController
 */
class JsonCardHandler
{
    /**
     * Returns an array with data for /card/deck route
     * @return array<string,string|array<string>>
     */
    public function getDeckRouteData(DeckOfCards $deck): array
    {
        $data = [
            'cards' => $deck->getAsString(),
        ];
        return $data;
    }

    /**
     * Returns an array with data for /card/deck route
     * @param array<Player> $players
     * @return array<mixed>
     */
    public function getDataForDraw(DeckOfCards $deck, array $players, int $number=1): array
    {
        $playerData = [];
        foreach($players as $player) {
            $playerData[] = $this->deal($deck, $player, $number);
        }

        $data = [
            'players' => $playerData,
            'cardsLeft' => $deck->getCardCount(),
        ];
        return $data;
    }


    /**
     * Returns an array with player data after a draw
     * @return  array<string,array<string>|string>
     */
    protected function deal(DeckOfCards $deck, Player $player, int $number): array
    {
        $player->draw($deck);
        if ($number > 1) {
            $player->drawMany($deck, $number-1);
        }

        $data = [
            'player' => $player->getName(),
            'cards' => $player->showHandAsString(),
        ];

        return $data;
    }
}
