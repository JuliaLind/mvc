<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle players turn in Game 21
 */
class PlayersTurn
{
    /**
     * @var EndRound $endRound
     */
    private $endRound;

    public function __construct(EndRound $endRound=new EndRound())
    {
        $this->endRound = $endRound;
    }

    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function main(Game21Easy $game): array
    {
        $game->deal();
        $roundOver = $game->evaluate();
        if ($roundOver === true) {
            $this->endRound->main($game);
        }
        $flash = $game->generateFlash();
        return $flash;
    }
}
