<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectCard\Deck;

trait OneRoundTrait
{
    private Grid $player;
    private Grid $house;
    private Deck $deck;
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    abstract private function playerSuggest(): void;

    public function oneRound(int $row, int $col): bool
    {
        $this->player->addCard($row, $col, $this->card);
        $this->lastRound['player'] = [$row, $col];
        $this->housePlaceCard();
        if ($this->house->getCardCount() === 25) {
            $this->finished = true;
            return true;
        }
        $this->card = $this->deck->deal();
        $this->playerSuggest();
        return false;
    }

    private function housePlaceCard(): void
    {
        $card = $this->deck->deal();
        $suggestion = $this->moveEvaluator->suggestion($this->house->getCards(), $card, $this->deck->possibleCards());
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion['slot'];
        $this->lastRound['house'] = $slot;
        $this->house->addCard($slot[0], $slot[1], $card);
    }
}
