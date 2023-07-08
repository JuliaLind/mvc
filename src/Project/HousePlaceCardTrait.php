<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Trait that handles the action of house placing
 * a card
 */
trait HousePlaceCardTrait
{
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private Grid $house;

    /**
     * Contains the coordinates of the slots
     * where the house and the player placed the
     * cards in the last round
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];

    /**
     * Picks a card from the deck and places
     * into the houses grid
     */
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
