<?php

namespace App\ProjectRules;

class SameOfAKind extends Rule implements RuleInterface
{
    use SameRankTrait;

    /**
     * Constructor
     */
    public function __construct(int $minCountRank)
    {
        parent::__construct();
        $this->minCountRank = $minCountRank;
    }
}
