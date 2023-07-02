<?php

namespace App\ProjectRules;

class SameOfAKind implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use SameOfAKindTrait;
    use SameOfAKindTrait2;
    use SameOfAKindTrait3;
    use SameOfAKindTrait4;
    use RuleDataTrait;

    private int $minCountRank;

    /**
     * Constructor
     */
    public function __construct(
        int $minCountRank
    ) {
        switch ($minCountRank) {
            case 4:
                $this->name = "Four Of A Kind";
                $this->points = 50;
                break;
            case 3:
                $this->name = "Three Of A Kind";
                $this->points = 10;
                break;
            default:
                $this->name = "One Pair";
                $this->points = 2;
                break;
        }
        $this->minCountRank = $minCountRank;
    }

    /**
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);

        return max($ranks) >= $this->minCountRank;
    }
}
