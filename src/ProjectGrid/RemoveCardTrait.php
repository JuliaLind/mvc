<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for removing a card from the grid
 */
trait RemoveCardTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    private int $cardCount = 0;

    /**
     * Removes a card from the grid and dicreases the card count attr by 1
     */
    public function removeCard(int $row, int $col): string
    {
        if (!array_key_exists($row, $this->grid) || !array_key_exists($col, $this->grid[$row])) {
            throw new SlotEmptyException();
        }
        $card = $this->grid[$row][$col];
        unset($this->grid[$row][$col]);
        if ($this->grid[$row] === []) {
            unset($this->grid[$row]);
        }
        $this->cardCount -= 1;
        return $card;
    }
}
