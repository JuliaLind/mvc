<?php

namespace App\ProjectRules;

/**
 * Determins if the Full House rule is scored or
 * possible to score
 */
class FullHouse implements RuleInterface
{
    use CountByRankTrait;
    use FirstCheckTrait;
    use FullHouseScoredTrait;
    use FullHouseTrait2;
    use RuleDataTrait;

    public function __construct()
    {
        $this->name = "Full House";
        $this->points = 25;
    }
}
