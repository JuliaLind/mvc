<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Creates a number of players
 */
class PlayerCreator
{
    /**
     * @return array<Player> an array with players
     */
    public function createPlayers(int $number): array
    {
        $players = [];
        for ($i = 1; $i <= $number; $i++) {
            $player = new Player("player {$i}");
            array_push($players, $player);
        };
        return $players;
    }
}
