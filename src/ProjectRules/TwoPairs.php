<?php

namespace App\ProjectRules;

/**
 * Class for determining if a full hand has scored
 * the Two Pairs Rule.
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


    public function __construct()
    {
        $this->name = "Two Pairs";
        $this->points = 5;
    }
}
