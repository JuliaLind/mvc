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
     * @param  array<string,array<array<Card>>> $hands
     * @return  array<string,array<array<string,int|string>>|int>
     */
    public function checkForWin(array $hands): array
    {
        $rules = $this->rules;
        $result = [];
        $total = 0;
        /**
         * @var string $type
         * @var array<array<Card>> $arr
         */
        foreach($hands as $type => $arr) {
            foreach($arr as $index => $hand) {
                $bool = false;
                /**
                 * @var string $name
                 */
                foreach($rules as $name => $options) {
                    /**
                     * @var RuleInterface $rule
                     */
                    $rule = $options['scored'];
                    if ($rule->check($hand) === true) {
                        $bool = true;
                        $result[$type][$index]['name'] = $name;
                        /**
                         * @var int $points
                         */
                        $points = $options['points'];
                        $result[$type][$index]['points'] = $points;
                        $total += $points;
                        break;
                    }
                }
                if ($bool === false) {
                    $result[$type][$index]['name'] = 'None';
                    $result[$type][$index]['points'] = 0;
                }
            }
        }
        $result['total'] = $total;
        return $result;
    }
}
