<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectRules\WinEvaluator;
use App\ProjectRules\MoveEvaluator;

class ApiGame3
{
    /**
     * @return array<mixed>
     */
    public function results(
        MoveEvaluator $moveEvaluator = new MoveEvaluator(),
        WinEvaluator $winEvaluator = new WinEvaluator(),
        Grid $grid = new Grid(),
        Deck $deck = new Deck(),
    ): array {
        while ($grid->getCardCount() < 25) {
            $card = $deck->deal();
            /**
             * @var array<string,array<int,int>|int|string> $suggestion
             */
            $suggestion = $moveEvaluator->suggestion($grid->getCards(), $card, $deck->getCards());
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
        $results = $winEvaluator->results($grid->getCards());
        return [
            "results" => $results,
            "grid" => $grid->getCards(),
            "remaining cards" => $deck->getCards()
        ];
    }
}
