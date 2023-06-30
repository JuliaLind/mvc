<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;

trait HousePlaceCardTrait
{
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private Grid $house;
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];


    private function housePlaceCard(): void
    {
        $card = $this->deck->deal();
        $suggestion = $this->evaluator->suggestion($this->house, $card, $this->deck->possibleCards());
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion['slot'];
        $this->lastRound['house'] = $slot;
        $this->house->addCard($slot[0], $slot[1], $card);
    }
}
