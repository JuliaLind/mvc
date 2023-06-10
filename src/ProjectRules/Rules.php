<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;
use App\ProjectCard\EmptyCellFinder;

// use App\ProjectGrid\Grid;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Rules
{
    /**
     * @var array<array<string,string|int|RuleInterface|RuleStatInterface>>
     */
    protected $rules = [];

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
                'scored' => new Straight(1),
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
                'scored' => new Straight(4),
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

    /**
     * @return array<array<string,string|int|RuleInterface|RuleStatInterface>>
     */
    public function getAll(): array
    {
        return $this->rules;
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

        foreach($rules as $options) {
            /**
             * @var string $name
             */
            $name = $options['name'];
            /**
             * @var RuleInterface $rule
             */
            $rule = $options['scored'];
            if ($rule->check($hand)) {
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

    /**
     * @param int $ruleNr
     * @param array<Card> $hand
     * @param array<Card> $deck
     */
    public function checkSingle($hand, $deck, Card $card, $ruleNr): bool
    {
        $rules = $this->rules;
        $rule = $rules[$ruleNr];
        /**
         * @var RuleInterface $scored
         */
        $scored = $rule['scored'];
        /**
         * @var RuleStatInterface $possible
         */
        $possible = $rule['possible'];
        $count = count($hand);
        return ($count === 4 && $scored->check([...$hand, $card])) || ($count < 4 && $count > 0 && $possible->check($hand, $deck, $card));
    }
}
