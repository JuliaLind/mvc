<?php

namespace App\ProjectRules;

trait CountByRankTrait
{
    use SubCountTrait;

    /**
     * Used in the following classes and traits:
     * FullHouseScoredTrait,
     * FullHouseTrait2,
     * FullHouseTrait3,
     * RankLimitsTrait,
     * SameOfAKind,
     * SameOfAKindTrait,
     * SameOfAKindTrait2,
     * SameOfAKindTrait3,
     * StraightScoredTrait,
     * StraightTrait,
     * TwoPairsScoredTrait,
     * TwoPairsTrait,
     * TwoPairsTrait2,
     * TwoPairsTrait3,
     *
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return array<array<int|string,int>>
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
