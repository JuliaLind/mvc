<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class SameOfAKind implements RuleInterface
{
    use SameRankTrait;

    protected CardCounter $cardCounter;

    /**
     * Constructor
     */
    public function __construct(
        int $minCountRank,
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
        $this->minCountRank = $minCountRank;
    }
}
