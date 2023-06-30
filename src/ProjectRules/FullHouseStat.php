<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class FullHouseStat implements RuleStatInterface
{
    use CountByRankTrait;
    use FirstCheckTrait;
    use FullHouseStatTrait2;
    use FullHouseStatTrait3;
    use FullHouseStatTrait4;
    use FullHouseStatTrait5;
    use FullHouseStatTrait6;
    use FullHouseStatTrait7;
    use FullHouseStatTrait8;
}
