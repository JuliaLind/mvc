<?php

namespace App\Project;

use App\ProjectGrid\Grid;

class ApiGame2
{
    /**
     * Pick to card from a new shuffled deck and places
     * into a new empty grid into the slot chosen by user
     * @return array<mixed>
     */
    public function oneRound(int $row, int $col, Grid $grid = new Grid(), Deck $deck = new Deck()): array
    {
        $card = $deck->deal();
        $grid->addCard($row, $col, $card);

        return [
            "placement" => "You placed card '{$card}' on row {$row} column {$col}",
            "grid" => $grid,
            "remaining cards" => $deck
        ];
    }
}
