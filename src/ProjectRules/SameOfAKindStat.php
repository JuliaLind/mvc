<?php

namespace App\ProjectRules;

class SameOfAKindStat implements RuleStatInterface
{
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
    public function check3(array $deck): bool
    {
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        return max($ranksDeck) >= $this->minCountRank;
    }
}
