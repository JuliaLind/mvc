<?php

namespace App\ProjectRules;

/**
 * Determins if the Full House rule is scored or
 * possible to score.
 * From kmom10/Project
 */
class FullHouse implements RuleInterface
{
    use CountByRankTrait;
    use FirstCheckTrait;
    use FullHouseScoredTrait;
    use FullHouseTrait2;
    use RuleDataTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = "Full House";
        $this->points = 25;
    }
}
