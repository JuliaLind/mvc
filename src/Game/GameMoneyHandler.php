<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle game in the Game21Controller
 */
class GameMoneyHandler
{
    /**
     * Updates game-object to next round, returns some data
     * for the route's template
     * @return array<int|string>
     */
    public function selectAmount(Game21Interface $game): array
    {
        $nextRoundData = $game->nextRound();
        $data = [
            'page' => "game no-header card",
            'url' => "/game",
        ];
        $data = array_merge($nextRoundData, $data);
        return $data;
    }

    /**
     * Updates the amount of money in the game obejcts moneypot
     * @return void
     */
    public function bet(int $amount, Game21Interface $game): void
    {
        $game->addToMoneyPot($amount);
    }
}
