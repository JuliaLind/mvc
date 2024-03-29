<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Used in API route. Contains method that deals a card and places into
 * a grid based on calculated suggestion, used in the class ApiGame1, from kmom10/Project
 */
trait ApiGame1OneRoundTrait
{
    use ApiGame1ResetTrait;

    private Grid $grid;
    private Deck $deck;

    /**
     * Picks top card from the deck and places into grid
     * based on calculated suggestion.
     * @return array<mixed>
     */
    public function oneRound(RuleEvaluator $evaluator = new RuleEvaluator()): array
    {
        if ($this->grid->getCardCount() === 25) {
            $this->reset();
        }
        $card = $this->deck->deal();

        $possibleCards = array_slice($this->deck->getCards(), 27);
        $suggestion = $evaluator->suggestion($this->grid, $card, $possibleCards);
        $slot = $suggestion['slot'];
        /**
         * @var array<int> $slot
         */
        $this->grid->addCard($slot[0], $slot[1], $card);

        $data = [
            'placed cards' => $this->grid->getCardCount(),
            "picked card" => $card,
            "suggestion" => $suggestion,
            "grid" => $this->grid,
            "possible cards" => $possibleCards,
            "remaining cards in deck" => $this->deck,
        ];
        $data['suggestion']['slot'] = [
            'row' => $slot[0],
            'col' => $slot[1]
        ];

        return $data;
    }
}
