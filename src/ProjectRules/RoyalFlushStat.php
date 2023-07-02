<?php

namespace App\ProjectRules;

class RoyalFlushStat implements RuleStatInterface
{
    use CountByRankTrait;
    use CountSuitAndRankTrait;
    use FirstCheckTrait;
    use GroupBySuitTrait;
    use SearchSpecificCardTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait2;
    use RoyalFlushStatTrait;
    use RoyalFlushStatTrait2;

}
