<?php

namespace App\ProjectRules;

/**
 * Class for the rules Four Of A Kind, Three Of A Kind
 * and One Pair. Responsible for checking if the rule has
 * been scored or is possible to score with/wihtout the
 * dealt card
 * From kmom10/Project
 */
class SameOfAKind implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use SameOfAKindTrait;
    use SameOfAKindTrait2;
    use SameOfAKindTrait3;
    use SameOfAKindTrait4;
    use RuleDataTrait;

    /**
     * Minimum number of cards of the same rank required to score
     * the rule. 4 for FourOfAKind, 3 for ThreeOfAKind
     * and 2 for OnePair
     */
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
     * Determines if the rule has been scored by comparing the maximum
     * number of ranks in the hand to the minimum number of ranks needed to score
     * the rule
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
