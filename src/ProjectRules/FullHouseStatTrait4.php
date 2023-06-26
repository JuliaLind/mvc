<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait4
{
    private function checkThree(bool $three, int $rank): bool
    {
        return $three === false && $rank >= 3;
    }
}
