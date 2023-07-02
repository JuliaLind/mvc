<?php

namespace App\ProjectRules;

trait FullHouseTrait6
{
    private function checkThree(bool $three, int $rank): bool
    {
        return $three === false && $rank >= 3;
    }
}
