<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Generates flash message to be displayed at the end of a round
 * or at the end of a game, from kmom03-04
 */
trait Game21FlashTrait
{
    protected Player21 $winner;
    protected bool $roundOver=false;
    protected bool $finished=false;

    /**
     * Determines the class of the message, warning or notice.
     * Notice is used when player has won and worning when the bank has won
     */
    protected function messageType(string $winner): string
    {
        $type = "notice";
        if ($winner === "Bank") {
            $type = "warning";
        }
        return $type;
    }

    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    protected function generateFlash(): array
    {
        $type = "";
        $message = "";
        $winner = $this->winner->getName();

        if ($this->roundOver) {
            $type = $this->messageType($winner);
            $what = "Game";
            if (!$this->finished) {
                $what = "Round";
            }
            return [$type, "{$what} over, {$winner} won!"];

        }
        return [$type, $message];
    }
}
