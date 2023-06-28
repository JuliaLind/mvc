<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";


class BanksTurn
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
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function main(Game21Easy $game): array
    {
        $game->dealBank();
        $game->evaluateBank();
        $this->endRound->main($game);
        $flash = $game->generateFlash();
        return $flash;
    }
}
