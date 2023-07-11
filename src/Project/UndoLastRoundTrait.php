<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

trait UndoLastRoundTrait
{
    /**
     * The latest card that has been dealt to the player
     */
    private string $card;
    private Deck $deck;
    private Grid $house;
    /**
     * Contains the coordinates of the slots
     * where the house and the player placed the
     * cards in the last round
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    private Grid $player;


    /**
     * Undoes the last round. The latest card that is dealt to the player
     * is placed back into the deck. The latest placed card in the houses grid
     * is also removed and placed back into the deck. And the latest card placed by the player is lifted from the player's grid.
     * The suggestion data for the player is re-generated based on the updated grid
     */
    public function undoLastRound(): void
    {
        $houseSlot = $this->lastRound['house'];
        $playerSlot = $this->lastRound['player'];
        $houseCard = $this->house->removeCard($houseSlot[0], $houseSlot[1]);
        $playerCard = $this->player->removeCard($playerSlot[0], $playerSlot[1]);
        $this->deck->addCard($this->card);
        $this->deck->addCard($houseCard);
        $this->card = $playerCard;
        $this->lastRound = [];

    }
}
