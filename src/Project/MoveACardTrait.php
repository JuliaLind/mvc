<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

/**
 * Handles the cheat of moving a placed card from one slot to another
 */
trait MoveACardTrait
{
    /**
     * The slot from which to move the card
     * @var array<int> $fromSlot
     */
    private array $fromSlot = [];
    /**
     * Contains the coordinates of the slots
     * where the house and the player placed the
     * cards in the last round
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    private Grid $player;

    /**
     * Provides a suggestion to the player on which slot to
     * place the card in. Also provides data for each hand on
     * the best possible rule that can be achieved with the dealt card
     * and best possible rule without the dealt card
     */
    abstract private function playerSuggest(): void;

    /**
     * Sets the slot from which to pick up the placed card
     */
    public function setFromSlot(int $row, int $col): void
    {
        $this->fromSlot = [$row, $col];
        $this->lastRound = [];
    }

    /**
     * Picks up card from the previously set from-slot
     * and places it in the new slot
     * Generates new suggestion data for the player
     * based on the updated grid
     */
    public function moveCard(int $row, int $col): void
    {
        $card = $this->player->removeCard($this->fromSlot[0], $this->fromSlot[1]);
        $this->player->addCard($row, $col, $card);
        $this->fromSlot = [];
        $this->playerSuggest();
    }
}
