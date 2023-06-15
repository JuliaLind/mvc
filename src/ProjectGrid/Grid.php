<?php

namespace App\ProjectGrid;


/**
 * Class representing a grid for cards
 */
class Grid
{
    /**
     * @var array<array<string>> $grid
     * [
     * [01, 02, 03, 04, 05],
     * [11, 12, 13, 14, 15],
     * [21, 22, 23, 24, 25],
     * [31, 32, 33, 34, 35],
     * [41, 42, 43, 44, 45],
     * ]
     */
    private array $grid = [];

    private int $cardCount = 0;

    public function addCard(int $row, int $col, string $card): void
    {
        $grid = $this->grid;
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            throw new SlotNotEmptyException();
        }
        $this->grid[$row][$col] = $card;
        $this->cardCount += 1;
    }

    public function getCardCount(): int
    {
        return $this->cardCount;
    }

    /**
     * for testing purposes
     * @param array<array<string>> $grid
     */
    public function setCards(array $grid): void
    {
        $this->grid = $grid;
    }

    /**
     * @return array<array<string>>
     */
    public function getCards(): array
    {
        return $this->grid;
    }

    /**
     * @return array<string,array<array<string>>>
     */
    public function rowsAndCols(GridCols $gridCols = new GridCols()): array
    {
        $rows = $this->grid;
        $cols = $gridCols->all($rows);
        return [
            'rows' => $rows,
            'cols' => $cols
        ];
    }
}
