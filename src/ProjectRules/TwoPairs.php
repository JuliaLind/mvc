<?php

namespace App\ProjectRules;

/**
 * Determins if the Two Pairs rule is scored or
 * possible to score
 */
class TwoPairs implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use RuleDataTrait;
    use TwoPairsScoredTrait;
    use TwoPairsTrait;
    use TwoPairsTrait2;
    use TwoPairsTrait3;
    use TwoPairsTrait4;
    use TwoPairsTrait5;
    use TwoPairsTrait6;
    use TwoPairsTrait7;
    use TwoPairsTrait8;
    use TwoPairsTrait9;
    use TwoPairsTrait10;


    public function __construct()
    {
        $this->name = "Two Pairs";
        $this->points = 5;
    }
}
