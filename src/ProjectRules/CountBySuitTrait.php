<?php

namespace App\ProjectRules;

trait CountBySuitTrait
{
    use SubCountTrait;

    /**
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
