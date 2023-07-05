<?php

namespace App\ProjectRules;

/**
 * Determins if the Straight rule is scored or
 * possible to score
 */
class Straight implements RuleInterface
{
    use CountByRankTrait;
    use FirstCheckTrait;
    use RuleDataTrait;
    use StraightScoredTrait;
    use StraightTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = "Straight";
        $this->points = 15;
    }
}
