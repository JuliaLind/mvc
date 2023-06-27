<?php

namespace App\ProjectRules;

trait FullHouseStatTrait4
{
    private function checkThree(bool $three, int $rank): bool
    {
        return $three === false && $rank >= 3;
    }
}
