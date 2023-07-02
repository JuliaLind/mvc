<?php

namespace App\ProjectRules;

/**
 * Determins if the Flush rule is scored or
 * possible to score
 */
class Flush implements RuleInterface
{
    use AdditionalValueTrait;
    use CountBySuitTrait;
    use FirstCheckTrait;
    use FlushScoredTrait;
    use FlushTrait;
    use FlushTrait2;
    use FlushTrait3;
    use RuleDataTrait;
    use SameSuitTrait;

    public function __construct()
    {
        $this->name = "Flush";
        $this->points = 20;
    }
}
