<?php

namespace App\ProjectRules;

class StraightStat implements RuleStatInterface
{
    use FirstCheckTrait;
    use RankLimitsTrait;
    use StraightStatTrait;
    use StraightStatTrait2;
    use StraightStatTrait3;
    use MinRankLimitsTrait;
    use CountByRankTrait;

}
