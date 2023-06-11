<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;
use App\ProjectCard\EmptyCellFinder;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Rules
{
    /**
     * @var array<array<string,string|int|RuleInterface>>
     */
    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            [
                'name' => 'Royal Flush',
                'points' => 100,
                'scored' => new RoyalFlush()
            ],
            [
                'name' => 'Straight Flush',
                'points' => 75,
                'scored' => new Straight(1)
            ],
            [
                'name' => 'Four Of A Kind',
                'points' => 50,
                'scored' => new SameOfAKind(4)
            ],
            [
                'name' => 'Full House',
                'points' => 25,
                'scored' => new FullHouse()
            ],
            [
                'name' => 'Flush',
                'points' => 20,
                'scored' => new Flush()
            ],
            [
                'name' => 'Straight',
                'points' => 15,
                'scored' => new Straight(4)
            ],
            [
                'name' => 'Three Of A Kind',
                'points' => 10,
                'scored' => new SameOfAKind(3)
            ],
            [
                'name' => 'Two Pairs',
                'points' => 5,
                'scored' => new TwoPairs()
            ],
            [
                'name' => 'One Pair',
                'points' => 2,
                'scored' => new SameOfAKind(2)
            ],
        ];
    }

    /**
     * @return array<array<string,string|int|RuleInterface>>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array<array<string,string|int|RuleInterface>> $rules
     */
    public function setRules($rules): void
    {
        $this->rules = $rules;
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
}
