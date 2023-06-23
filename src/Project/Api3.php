<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectRules\WinEvaluator;
use App\ProjectRules\MoveEvaluator;

use Symfony\Component\HttpFoundation\Request;

class Api3
{
    /**
     * @return array<mixed>
     */
    public function results(
        MoveEvaluator $moveEvaluator = new MoveEvaluator(),
        WinEvaluator $winEvaluator = new WinEvaluator(),
        GridGraphic $gridGraphic = new GridGraphic(),
        Grid $grid = new Grid(),
        Deck $deck = new Deck(),
    ): array {
        $deck->shuffle();
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
            "grid" => $gridGraphic->graphic($grid->getCards()),
            "remaining cards" => $deck->getCards()
        ];
    }
}
