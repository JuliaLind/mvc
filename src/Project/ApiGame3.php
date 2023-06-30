<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;

class ApiGame3
{
    /**
     * @return array<mixed>
     */
    public function results(
        RuleEvaluator $evaluator = new RuleEvaluator(),
        Grid $grid = new Grid(),
        Deck $deck = new Deck(),
    ): array {
        while ($grid->getCardCount() < 25) {
            $card = $deck->deal();
            /**
             * @var array<string,array<int,int>|int|string> $suggestion
             */
            $suggestion = $evaluator->suggestion($grid, $card, $deck->getCards());
            /**
             * @var array<int>
             */
            $slot = $suggestion['slot'];
            /**
             * @var int $row
             */
            $row = $slot[0];
            /**
             * @var int $col
             */
            $col = $slot[1];
            $grid->addCard($row, $col, $card);
        }
        $results = $evaluator->results($grid);
        return [
            "results" => $results,
            "grid" => $grid->getRows(),
            "remaining cards" => $deck->getCards()
        ];
    }
}
