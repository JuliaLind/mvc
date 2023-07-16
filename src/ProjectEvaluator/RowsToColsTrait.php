<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for convreint an array of horizontal hands into and array of vertical hands,
 * from kmom10/Project
 */
trait RowsToColsTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
     * Used in:
     * FinalResultsTrait,
     * RowsToColsTrait
     *
     * Returns a two-dimensional array
     * wich correspons to an "inverted version" of the grid,
     * (i.e. an array with vertical hands)
     * @param array<array<string>> $rows
     * @return array<array<string>>
     */
    private function getCols($rows): array
    {
        $cols = [];
        foreach($rows as $row => $cards) {
            foreach($cards as $col => $card) {
                $cols[$col][$row] = $card;
            }
        }
        return $cols;
    }
}
