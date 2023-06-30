<?php

namespace App\ProjectRules;

class FlushStat implements RuleStatInterface
{
    use CountBySuitTrait;
    use SameSuitTrait;
    use FirstCheckTrait;
    use FlushStatTrait2;
    use FlushStatTrait3;
    use FlushStatTrait4;
}
