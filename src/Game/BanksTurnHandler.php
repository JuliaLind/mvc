<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class BanksTurnHandler
{
    /**
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function bankDraw(Game21Interface $game): array
    {
        $game->dealBank();
        $game->evaluateBank();
        $game->endRound();

        $flash = $game->generateFlash();
        return $flash;
    }
}
