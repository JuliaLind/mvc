<?php

namespace App\ProjectRules;

trait TwoPairsTrait2
{
    /**
     * @param array<string> $cards
     */
    abstract public function check3(array $cards): bool;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        return $this->check3($hand);
    }
}
