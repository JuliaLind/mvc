<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class OnePairStat extends RuleStat implements RuleStatInterface
{
    use RuleTrait;
    use SameRankStatTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->minCountRank = 2;
    }
}
