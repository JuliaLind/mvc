<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait5
{
    private function checkBoth(bool $three, bool $two): bool
    {
        return $three && $two;
    }
}
