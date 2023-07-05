<?php

namespace App\ProjectRules;

/**
 * Determins if the Two Pairs rule is scored or
 * possible to score
 */
class TwoPairs implements RuleInterface
{
    use CountByRankTrait;
    use RuleDataTrait;
    use TwoPairsScoredTrait;
    use TwoPairsTrait;
    use TwoPairsTrait2;
    use TwoPairsTrait8;


    public function __construct()
    {
        $this->name = "Two Pairs";
        $this->points = 5;
    }
}
