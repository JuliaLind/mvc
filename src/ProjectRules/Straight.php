<?php

namespace App\ProjectRules;

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

    public function __construct()
    {
        $this->name = "Straight";
        $this->points = 15;
    }
}
