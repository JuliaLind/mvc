<?php

namespace App\ProjectRules;

class Rules
{
    /**
     * @var array<string,string|int|RuleInterface|RuleStatInterface>
     */
    protected $rules = [];

    public function __construct()
    {
        $rules = [
            'Royal Flush' => [
                'points' => 100,
                'scored' => new RoyalFlush(),
                'possible' => new RoyalFlushStat()
            ],
            'Straight Flush' => [
                'points' => 70,
                'scored' => new Straight(1),
                'possible' => new StraightFlushStat()
            ],
            'Four Of A Kind' => [
                'points' => 50,
                'scored' => new SameOfAKind(4),
                'possible' => new SameOfAKindStat(4)
            ],
            'Full House' => [
                'points' => 25,
            ],
            'Flush' => [
                'points' => 20,
            ],
            'Straight' => [
                'points' => 15,
                'scored' => new Straight(4),
                'possible' => new StraightStat()
            ],
            'Three Of A Kind' => [
                'points' => 10,
                'scored' => new SameOfAKind(3),
                'possible' => new SameOfAKindStat(3)
            ],
            'Two Pairs' => [
                'points' => 5,
                'scored' => new TwoPairs(),
                'possible' => new TwoPairsStat()
            ],
            'One Pair' => [
                'points' => 2,
                'scored' => new SameOfAKind(2),
                'possible' => new SameOfAKindStat(2)
            ],
        ];
    }
}
