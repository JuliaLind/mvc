<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle the routes in CardController
 */
class CardHandler
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

    /**
     * Returns an array with data for /card/deck route
     * @param array<Player> $players
     * @return array<string,array<int,array<string,array<array<string>>|string>>|int|string>
     */
    public function getDataForDraw(DeckOfCards $deck, array $players, int $number=1): array
    {
        $playerData = [];
        foreach($players as $player) {
            $playerData[] = $this->deal($deck, $player, $number);
        }
        $count = count($players);

        // $players[] = [
        //     'playerdrawName' => $player->getName(),
        //     'cards' => $player->showHandGraphic(),
        // ];
        $data = [
            'title' => "Draw {$number} cards for {$count} players",
            'players' => $playerData,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];
        return $data;
    }


    /**
     * Returns an array with player data after a draw
     * @return array<string,array<array<string>>|string>
     */
    protected function deal(DeckOfCards $deck, Player $player, int $number): array
    {
        $player->draw($deck);
        if ($number > 1) {
            $player->drawMany($deck, $number-1);
        }

        $data = [
            'playerName' => $player->getName(),
            'cards' => $player->showHandGraphic(),
        ];

        return $data;
    }
}
