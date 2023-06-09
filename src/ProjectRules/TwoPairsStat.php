<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    use SameRankStatTrait;
    protected int $rank;

    /**
     * Constructor
     */
    public function __construct(int $minCountRank=2)
    {
        parent::__construct();
        $this->minCountRank = $minCountRank;
    }

    protected function checkCountRanks(): bool
    {
        return count($this->hand) > count($this->ranksHand);
    }
}
