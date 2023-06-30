<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for retrieving the count of cards placed in the grid
 */
trait CardCountTrait
{
    private int $cardCount = 0;

    /**
     * Returns the number of cards in the grid
     */
    public function getCardCount(): int
    {
        return $this->cardCount;
    }
}
