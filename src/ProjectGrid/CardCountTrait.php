<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

trait CardCountTrait
{
    private int $cardCount = 0;

    public function getCardCount(): int
    {
        return $this->cardCount;
    }
}
