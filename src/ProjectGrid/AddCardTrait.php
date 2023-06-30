<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

trait AddCardTrait
{
    /**
     * @var array<array<string>> $grid
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
}
