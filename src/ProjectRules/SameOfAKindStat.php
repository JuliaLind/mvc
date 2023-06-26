<?php

namespace App\ProjectRules;

class SameOfAKindStat extends RuleStat implements RuleStatInterface
{
    use SameRankStatTrait;
    use SameRankSingleStatTrait;

    /**
     * Constructor
     */
    public function __construct(int $minCountRank)
    {
        parent::__construct();
        $this->minCountRank = $minCountRank;
    }

    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];
        return $deck != [] && max($ranksDeck) >= $this->minCountRank;
    }
}
