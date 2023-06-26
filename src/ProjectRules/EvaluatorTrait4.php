<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait EvaluatorTrait4
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @param array<string,string|RuleStatInterface|int> $rule
     * @return array<string,string|int>
     */
    public function checkSingleRule2(
        array $hands,
        int $index,
        array $deck,
        array $rule,
        // bool $possibleWhenEmpty
    ): array {
        /**
         * @var string $ruleName
         */
        $ruleName = $rule['name'];
        /**
         * @var int $rulePoints
         */
        $rulePoints = $rule['points'];
        /**
         * @var RuleStatInterface $possible
         */
        $possible = $rule['possible'];
        if (array_key_exists($index, $hands)) {
            if (count($hands[$index]) === 5) {
                return [
                    'points' => -1,
                    'rule' => ""
                ];
            }
            if ($possible->check2($hands[$index], $deck)) {
                $points = $rulePoints + 1;
                if ($points >= 5) {
                    // some additional points to prioritized the already started rows/cols over empty
                    $points += count($hands[$index]);
                }
                return [
                    'points' => $points,
                    'rule' => $ruleName
                ];
            }
            return [
                'points' => 0,
                'rule' => ""
            ];
        }
        if ($possible->check3($deck)) {
            return [
                'points' => $rulePoints,
                'rule' => $ruleName
            ];
        }
        return [
            'points' => 1,
            'rule' => ""
        ];
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    public function checkForRule2(array $hands, int $index, array $deck)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            $data = $this->checkSingleRule2($hands, $index, $deck, $rule);
            $handPoints = $data['points'];
            if ($handPoints > 1) {
                break;
            }
        }
        return $data;
    }
}
