<?php

namespace App\Project;

use App\ProjectGrid\Grid;

/**
 * Represents part of the logic of the Poker Squares game. Places a card into an empty grid
 * accoring to passed arguemnts and returns data containing the grid, the remaining card
 * and a message describing the card palcement for API route, from kmom10/Project
 */
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
