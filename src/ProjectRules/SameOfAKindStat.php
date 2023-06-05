<?php

namespace App\ProjectRules;

class SameOfAKindStat extends RuleStat implements RuleStatInterface
{
    use SameRankStatTrait;

    /**
     * Constructor
     */
    public function __construct(int $minCountRank)
    {
        parent::__construct();
        $this->minCountRank = $minCountRank;
    }
}
