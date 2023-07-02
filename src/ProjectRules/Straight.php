<?php

namespace App\ProjectRules;

/**
 * Determins if the Straight rule is scored or
 * possible to score
 */
class Straight implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use FirstCheckTrait;
    use MinRankLimitsTrait;
    use RankLimitsTrait;
    use RuleDataTrait;
    use StraightScoredTrait;
    use StraightTrait;
    use StraightTrait2;
    use StraightTrait3;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = "Straight";
        $this->points = 15;
    }
}
