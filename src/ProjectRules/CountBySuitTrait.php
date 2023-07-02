<?php

namespace App\ProjectRules;

trait CountBySuitTrait
{
    use SubCountTrait;

    /**
     * Used in the following traits:
     *
     * Returns an associative array
     * where keys are the suits present amongst
     * the cards and the values are the count of
     * each suit
     * @param array<string> $cards
     * @return array<string,int>
     */
    private function countBySuit($cards): array
    {
        $suits = [];
        foreach($cards as $card) {
            /**
             * @var array<string,int> $suits
             */
            $suits = $this->subCount($card[-1], $suits);
        }
        return $suits;
    }
}
