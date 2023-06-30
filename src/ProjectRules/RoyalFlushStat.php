<?php

namespace App\ProjectRules;

class RoyalFlushStat implements RuleStatInterface
{
    use CountByRankTrait;
    use CountSuitAndRankTrait;
    use StraightFlushStatTrait;
    use SearchSpecificCardTrait;
    use GroupBySuitTrait;
    use FirstCheckTrait;
    use RoyalFlushStatTrait;
    use RoyalFlushStatTrait2;
    use StraightStatTrait2;
}
