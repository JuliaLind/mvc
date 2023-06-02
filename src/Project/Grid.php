<?php

namespace App\Project;

/**
 * Class representing a grid for cards
 */
class Grid
{
    /**
     * @var array<array<Card>> $grid
     * [
     * [01, 02, 03, 04, 05],
     * [11, 12, 13, 14, 15],
     * [21, 22, 23, 24, 25],
     * [31, 32, 33, 34, 35],
     * [41, 42, 43, 44, 45],
     * ]
     */
    private array $grid = [];

    public function addCard(int $row, int $col, Card $card): bool
    {
        $grid = $this->grid;
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            return false;
        }
        $this->grid[$row][$col] = $card;
        return true;
    }

    /**
     * for testing purposes
     * @param array<array<Card>> $grid
     */
    public function setCards(array $grid): void
    {
        $this->grid = $grid;
    }

    /**
     * @return array<array<Card>>
     */
    public function getCards(): array
    {
        return $this->grid;
    }

    /**
     * @return array<string,array<array<Card>>>
     */
    public function rowsAndCols(GridCols $gridCols = new GridCols()): array
    {
        $rows = $this->grid;
        $gridCols->setRows($rows);
        $cols = $gridCols->all();
        return [
            'rows' => $rows,
            'cols' => $cols
        ];
    }
}
