<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait EvaluatorTrait
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
    public function checkSingleRule(
        array $hands,
        int $index,
        array $deck,
        string $card,
        array $rule,
        bool $possibleWhenEmpty
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
            if ($possible->check($hands[$index], $deck, $card)) {
                return [
                    'points' => $rulePoints + 1,
                    'rule' => $ruleName
                ];
            }
            return [
                'points' => 0,
                'rule' => ""
            ];
        }
        if ($possibleWhenEmpty) {
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
    public function checkForRule(array $hands, int $index, array $deck, string $card)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            /**
             * @var RuleStatInterface $possible
             */
            $possible = $rule['possible'];
            $possibleWhenEmpty = $possible->check([], $deck, $card);

            $data = $this->checkSingleRule($hands, $index, $deck, $card, $rule, $possibleWhenEmpty);
            $handPoints = $data['points'];
            if ($handPoints > 0) {
                break;
            }
        }
        return $data;
    }
}
