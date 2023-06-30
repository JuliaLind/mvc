<?php

namespace App\ProjectRules;

trait CountByRankTrait
{
    use SubCountTrait;

    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    private function countByRank($cards): array
    {
        $ranks = [];
        foreach($cards as $card) {
            $ranks = $this->subCount(intval(substr($card, 0, -1)), $ranks);
        }
        return $ranks;
    }
}
