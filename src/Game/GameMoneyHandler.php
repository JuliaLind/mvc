<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

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
    public function selectAmount(Game21Easy $game, RoundHandler2 $handler = new RoundHandler2()): array
    {
        $nextRoundData = $handler->nextRound($game);
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
    public function bet(int $amount, Game21Easy $game): void
    {
        $game->addToMoneyPot($amount);
    }
}
