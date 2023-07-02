<?php

namespace App\ProjectRules;

class SameOfAKindStat implements RuleStatInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use SameOfAKindStatTrait;
    use SameOfAKindStatTrait2;
    use SameOfAKindStatTrait3;

    public function __construct(
        int $minCountRank,
    ) {
        $this->minCountRank = $minCountRank;
    }

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        return max($ranksDeck) >= $this->minCountRank;
    }
}
