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

    // public function __construct()
    // {
    //     $this->grid = [];
    // }

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
     * @return array<array<Card>>
     */
    public function setCards(array $grid)
    {
        $this->grid = $grid;
        return $this->grid;
    }

    /**
     * @return array<string,array<array<Card>>>
     */
    public function rowsAndCols(): array
    {
        $rows = $this->grid;
        $cols = [];
        foreach($rows as $row => $cards) {
            foreach($cards as $col => $card) {
                $cols[$col][$row] = $card;
            }
        }
        return [
            'rows' => $rows,
            'cols' => $cols
        ];
    }

    /**
     * @return array<string,bool|string>
     */
    public function slotData(int $row, int $col): array
    {
        $data = [
            'filled' => false,
            'img' => "",
            'alt' => ""
        ];
        $grid = $this->grid;
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            $card = $grid[$row][$col]->graphic();
            $data = [
                'filled' => true,
                ...$card,
            ];
        }
        return $data;
    }

    /**
     * @return  array<int,array<int,array<string,bool|string>>>
     */
    public function graphic(): array
    {
        $gridGraphic = [];
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $gridGraphic[$row][$col] = $this->slotData($row, $col);
            }
        }

        return $gridGraphic;
    }
}
