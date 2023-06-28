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
    public function generateFlash(): array
    {
        $type = "";
        $message = "";
        $winner = $this->winner->getName();

        if ($this->roundOver === true) {
            $type = $this->messageType($winner);
            $message = "Round over, {$winner} won!";
        }
        if ($this->finished === true) {
            $message = "Game over, {$winner} won!";
        }
        return [$type, $message];
    }
}
