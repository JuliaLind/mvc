<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

trait MoveACardTrait
{
    /**
     * @var array<int> $fromSlot
     */
    private array $fromSlot = [];
    private Grid $player;
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    abstract private function playerSuggest(): void;

    public function setFromSlot(int $row, int $col): void
    {
        $this->fromSlot = [$row, $col];
        $this->lastRound = [];
    }

    public function moveCard(int $row, int $col): void
    {
        $card = $this->player->removeCard($this->fromSlot[0], $this->fromSlot[1]);
        $this->player->addCard($row, $col, $card);
        $this->fromSlot = [];
        $this->playerSuggest();

    }
}
