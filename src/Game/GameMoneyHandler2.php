<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class GameMoneyHandler2
{
    /**
     * Updates the amount of money in the game obejcts moneypot
     * @return void
     */
    public function bet(int $amount, Game21Easy $game): void
    {
        $game->addToMoneyPot($amount);
    }
}
