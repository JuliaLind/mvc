<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class PlayerTurnHandler
{
    /**
     * @var RoundHandler $handler
     */
    private $handler;

    public function __construct(RoundHandler $handler=new RoundHandler())
    {
        $this->handler = $handler;
    }

    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function playerDraw(Game21Easy $game): array
    {
        $game->deal();
        $roundOver = $game->evaluate();
        if ($roundOver === true) {
            $this->handler->endRound($game);
        }
        $flash = $game->generateFlash();
        return $flash;
    }
}
