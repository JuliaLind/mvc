<?php

namespace App\ProjectRules;

use App\ProjectCard\EmptyCellFinder;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RuleStats2
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            [
                'name' => 'Royal Flush',
                'points' => 100,
                'possible' => new RoyalFlushStat()
            ],
            [
                'name' => 'Straight Flush',
                'points' => 75,
                'possible' => new StraightFlushStat()
            ],
            [
                'name' => 'Four Of A Kind',
                'points' => 50,
                'possible' => new SameOfAKindStat(4)
            ],
            [
                'name' => 'Full House',
                'points' => 25,
                'possible' => new FullHouseStat()
            ],
            [
                'name' => 'Flush',
                'points' => 20,
                'possible' => new FlushStat()
            ],
            [
                'name' => 'Straight',
                'points' => 15,
                'possible' => new StraightStat()
            ],
            [
                'name' => 'Three Of A Kind',
                'points' => 10,
                'possible' => new SameOfAKindStat(3)
            ],
            [
                'name' => 'Two Pairs',
                'points' => 5,
                'possible' => new TwoPairsStat()
            ],
            [
                'name' => 'One Pair',
                'points' => 2,
                'possible' => new SameOfAKindStat(2)
            ],
        ];
    }

    /**
     * @return array<array<string,RuleStatInterface|int|string>>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array<array<string,RuleStatInterface|int|string>> $rules
     */
    public function setRules($rules): void
    {
        $this->rules = $rules;
    }
}
