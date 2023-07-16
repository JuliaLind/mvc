<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for handling bank's turn in the 21 game, from kmom03-04
 */
trait BanksTurnTrait
{
    abstract protected function dealBank(): void;
    abstract protected function evaluateBank(): void;
    abstract protected function endRound(): void;
    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    abstract protected function generateFlash(): array;

    /**
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function banksTurn(): array
    {
        $this->dealBank();
        $this->evaluateBank();
        $this->endRound();
        $flash = $this->generateFlash();
        return $flash;
    }
}
