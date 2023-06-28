<?php

namespace App\Game;

use App\Cards\DeckOfCards;

require __DIR__ . "/../../vendor/autoload.php";


trait PlayersTurnTrait
{
    protected DeckOfCards $deck;
    protected Player21 $player;

    /**
     * Moves money from the money pot to the winner.
     * Determines if the game is finished,
     * and if it is - who the final winner is
     *
     * @return void
     */
    abstract protected function endRound(): void;
    /**
     * Called after the player has picked a card.
     *
     * @return bool true if player lost otherwise
     * false
     */
    abstract protected function evaluate(): bool;
    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    abstract protected function generateFlash(): array;



    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function playersTurn(): array
    {
        $this->player->draw($this->deck);
        if ($this->evaluate()) {
            $this->endRound();
        }
        $flash = $this->generateFlash();
        return $flash;
    }
}
