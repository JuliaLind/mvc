<?php

namespace App\ProjectRules;

class StraightStat implements RuleStatInterface
{
    use CountByRankTrait;
    use FirstCheckTrait;
    use MinRankLimitsTrait;
    use RankLimitsTrait;
    use StraightStatTrait;
    use StraightStatTrait2;
    use StraightStatTrait3;
}
