<?php

namespace App\ProjectRules;

trait CountSuitAndRankTrait
{
    use SubCountTrait;

    /**
     * @param array<string> $cards
     * @return  array<string,array<array<int|string,int>>>
     */
    private function countSuitAndRank($cards): array
    {
        $ranks = [];
        $suits = [];
        foreach($cards as $card) {
            $ranks = $this->subCount(intval(substr($card, 0, -1)), $ranks);
            $suits = $this->subCount($card[-1], $suits);
        }
        return [
            'ranks' => $ranks,
            'suits' => $suits,
        ];
    }
}
