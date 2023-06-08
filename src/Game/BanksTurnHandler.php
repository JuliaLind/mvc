<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class BanksTurnHandler
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
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function bankDraw(Game21Easy $game): array
    {
        $game->dealBank();
        $game->evaluateBank();
        $this->handler->endRound($game);
        $flash = $game->generateFlash();
        return $flash;
    }
}
