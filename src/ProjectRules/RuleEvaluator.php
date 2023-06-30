<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RuleEvaluator
{
    use EmptyCellTrait;
    use FinalResultsTrait;
    use ExtractRuleNamesTrait;
    use CheckEmptyGridTrait;
    use CheckFullHandTrait;
    use CheckWithCardTrait;
    use CheckWithoutCardTrait;
    use PointsAndRuleNameTrait;
    use PointsAndRuleNameTrait2;
    use RuleNameTrait;
    use RuleNameTrait2;
    use RulesWithCardTrait;
    use RulesWithoutCardTrait;
    use SlotTrait;
    use SuggestionTrait;

    /**
     * @var array<array<string,string|RuleInterface|RuleStatInterface|int>>
     */
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            [
                'name' => 'Royal Flush',
                'points' => 100,
                'scored' => new RoyalFlush(),
                'possible' => new RoyalFlushStat()
            ],
            [
                'name' => 'Straight Flush',
                'points' => 75,
                'scored' => new StraightFlush(),
                'possible' => new StraightFlushStat()
            ],
            [
                'name' => 'Four Of A Kind',
                'points' => 50,
                'scored' => new SameOfAKind(4),
                'possible' => new SameOfAKindStat(4)
            ],
            [
                'name' => 'Full House',
                'points' => 25,
                'scored' => new FullHouse(),
                'possible' => new FullHouseStat()
            ],
            [
                'name' => 'Flush',
                'points' => 20,
                'scored' => new Flush(),
                'possible' => new FlushStat()
            ],
            [
                'name' => 'Straight',
                'points' => 15,
                'scored' => new Straight(),
                'possible' => new StraightStat()
            ],
            [
                'name' => 'Three Of A Kind',
                'points' => 10,
                'scored' => new SameOfAKind(3),
                'possible' => new SameOfAKindStat(3)
            ],
            [
                'name' => 'Two Pairs',
                'points' => 5,
                'scored' => new TwoPairs(),
                'possible' => new TwoPairsStat()
            ],
            [
                'name' => 'One Pair',
                'points' => 2,
                'scored' => new SameOfAKind(2),
                'possible' => new SameOfAKindStat(2)
            ],
        ];
    }
}
