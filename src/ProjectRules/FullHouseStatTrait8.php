<?php

namespace App\ProjectRules;

trait FullHouseStatTrait8
{
    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    abstract public function check2(array $hand, array $deck): bool;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        return $this->check2($newHand, $deck);
    }
}
