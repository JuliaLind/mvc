<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;

class ApiGame1
{
    private Grid $grid;
    private Deck $deck;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->grid = new Grid();
        $deck = new Deck();
        $this->deck = $deck;
    }

    /**
     * @return array<mixed>
     */
    public function oneRound(RuleEvaluator $evaluator = new RuleEvaluator()): array
    {
        if ($this->grid->getCardCount() === 25) {
            $this->reset();
        }
        $card = $this->deck->deal();
        $deck = $this->deck->possibleCards();
        $suggestion = $evaluator->suggestion($this->grid, $card, $deck);
        $slot = $suggestion['slot'];
        /**
         * @var array<int> $slot
         */
        $this->grid->addCard($slot[0], $slot[1], $card);

        $data = [
            'placed cards' => $this->grid->getCardCount(),
            "picked card" => $card,
            "suggestion" => $suggestion,
            "grid" => $this->grid->getRows(),
            "possible cards" => $deck,
            "remaining cards in deck" => $this->deck->getCards(),
        ];
        $data['suggestion']['slot'] = [
            'row' => $slot[0],
            'col' => $slot[1]
        ];
        $this->deck->deal();
        return $data;
    }
}
