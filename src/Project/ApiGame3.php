<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Displays part of the logic of the Poker Squares game, evaluates results for a
 * full grid and returns the data for API route
 */
class ApiGame3
{
    /**
     * Bot fills a grid completely based on calculated suggestions and then
     * all 10 hands are evaluated and results are returned
     * @return array<mixed>
     */
    public function results(
        Deck $deck = new Deck(),
        Grid $grid = new Grid(),
        RuleEvaluator $evaluator = new RuleEvaluator(),
    ): array {
        while ($grid->getCardCount() < 25) {
            $card = $deck->deal();
            /**
             * @var array<string,array<int,int>|int|string> $suggestion
             */
            $suggestion = $evaluator->suggestion($grid, $card, array_slice($deck->getCards(), 27));
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
            "grid" => $grid,
            "remaining cards" => $deck
        ];
    }
}
