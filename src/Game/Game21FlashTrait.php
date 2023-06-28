<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

trait Game21FlashTrait
{
    protected Player21 $winner;
    protected bool $roundOver=false;
    protected bool $finished=false;

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
