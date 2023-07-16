<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for getting arrays with horisontal hands in the grid, from kmom10/Project
 */
trait RowsTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
     * Returns the actual grid (.i.e an
     * array with the horizontal hands)
     * @return array<array<string>>
     */
    public function getRows(): array
    {
        return $this->grid;
    }

    /**
     * Sets grid, used in testing only
     * @param array<array<string>> $grid
     */
    public function setGrid($grid): void
    {
        $this->grid = $grid;
    }
}
