<?php

namespace App\ProjectRules;

/**
 * Determins if the Flush rule is scored or
 * possible to score, from kmom10/Project
 */
class Flush implements RuleInterface
{
    use CountBySuitTrait;
    use FirstCheckTrait;
    use FlushScoredTrait;
    use FlushTrait;
    use FlushTrait2;
    use RuleDataTrait;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = "Flush";
        $this->points = 20;
    }
}
