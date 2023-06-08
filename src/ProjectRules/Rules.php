<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;

// use App\ProjectGrid\Grid;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Rules
{
    /**
     * @var array<string,array<string,int|RuleInterface|RuleStatInterface>>
     */
    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            'Royal Flush' => [
                'points' => 100,
                'scored' => new RoyalFlush(),
                'possible' => new RoyalFlushStat()
            ],
            'Straight Flush' => [
                'points' => 75,
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
                'scored' => new FullHouse(),
                'possible' => new FullHouseStat()
            ],
            'Flush' => [
                'points' => 20,
                'scored' => new Flush(),
                'possible' => new FlushStat()
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

    /**
     * @param array<Card> $hand
     * @return array<string,string|int>
     */
    public function checkHandForWin($hand): array
    {
        $rules = $this->rules;
        $result = [];

        $result['name'] = 'None';
        $result['points'] = 0;
        /**
         * @var string $name
         */
        foreach($rules as $name => $options) {
            /**
             * @var RuleInterface $rule
             */
            $rule = $options['scored'];
            if ($rule->check($hand) === true) {
                $result['name'] = $name;
                /**
                 * @var int $points
                 */
                $points = $options['points'];
                $result['points'] = $points;
                break;
            }
        }
        return $result;
    }
}
