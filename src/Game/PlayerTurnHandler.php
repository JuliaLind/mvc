<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class PlayerTurnHandler
{
    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function playerDraw(Game21Interface $game): array
    {
        $game->deal();
        $roundOver = $game->evaluate();
        if ($roundOver === true) {
            $game->endRound();
        }
        $flash = $game->generateFlash();
        return $flash;
    }
}
