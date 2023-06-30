<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for getting arrays with vertical hands
 * respectively horisontal hands in the grid
 */
trait RowsColsTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
     * Returns a two-dimensional array
     * wich correspons to an "inverted version" of the grid,
     * (i.e. an array with vertical hands)
     * @return array<array<string>>
     */
    public function getCols(): array
    {
        $rows = $this->grid;
        $cols = [];
        foreach($rows as $row => $cards) {
            foreach($cards as $col => $card) {
                $cols[$col][$row] = $card;
            }
        }
        return $cols;
    }

    /**
     * Returns the actual grid (.i.e an
     * array with the horizontal hands)
     * @return array<array<string>>
     */
    public function getRows(): array
    {
        return $this->grid;
    }
}
