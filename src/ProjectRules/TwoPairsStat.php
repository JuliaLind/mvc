<?php

namespace App\ProjectRules;

/**
 * Class that determins if the Two Pairs rule
 * if possible to score
 */
class TwoPairsStat implements RuleStatInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use TwoPairsStatTrait;
    use TwoPairsStatTrait2;
    use TwoPairsStatTrait3;
    use TwoPairsStatTrait4;
    use TwoPairsStatTrait5;
    use TwoPairsStatTrait6;
    use TwoPairsStatTrait7;
    use TwoPairsStatTrait8;
    use TwoPairsStatTrait9;
}
