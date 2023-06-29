<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectCard\Deck;

trait UndoLastRoundTrait
{
    private Grid $player;
    private Grid $house;
    private Deck $deck;
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    abstract private function playerSuggest(): void;

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
        $this->playerSuggest();
    }
}
