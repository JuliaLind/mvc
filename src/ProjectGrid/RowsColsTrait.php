<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

trait RowsColsTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
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
     * @return array<array<string>>
     */
    public function getRows(): array
    {
        return $this->grid;
    }
}
