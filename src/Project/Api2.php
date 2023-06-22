<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;

class Api2
{
    /**
     * @return array<mixed>
     */
    public function oneRound(int $row, int $col, Grid $grid = new Grid(), Deck $deck = new Deck(), GridGraphic $gridGraphic = new GridGraphic()): array
    {
        $card = $deck->deal();
        $grid->addCard($row, $col, $card);

        return [
            "placement" => "You placed card '{$card}' on row {$row} column {$col}",
            "grid" => $gridGraphic->graphic($grid->getCards()),
            "remaining cards" => $deck->getCards()
        ];
    }
}
