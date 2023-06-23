<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
class MoveEvaluator2
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

    public function __construct(
        EmptyCellFinder $finder = new EmptyCellFinder(),
        RuleStats2 $stats= new RuleStats2(),
        ColumnGetter $colGetter = new ColumnGetter(),
    ) {
        $this->rules = $stats->getRules();
        $this->finder = $finder;
        $this->colGetter = $colGetter;
    }

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
        if (array_key_exists($index, $hands) && count($hands[$index]) < 5 && $possible->check($hands[$index], $deck, $card)) {
            // points + 1 to prioritize started row over empty row
            return [
                'points' => $rulePoints + 1,
                'rule' => $ruleName
            ];
        }
        if (!array_key_exists($index, $hands)) {
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
        return [
            'points' => 0,
            'rule' => ""
        ];
    }

    /**
     * @param array<int,array<string,int|string>> $pointsRows
     * @param array<int,array<string,int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    public function slot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array
    {
        $slot = [];
        /**
         * @var string $rowRule
         */
        $rowRule = $pointsRows[$bestRow]['rule'];
        $colRule = "";
        $emptySlots = $this->finder->single($rows[$bestRow], $bestRow);
        $colPoints = 0;

        foreach($emptySlots as $emptySlot) {
            $col = $emptySlot[1];
            /**
             * @var int $pointsCol
             */
            $pointsCol = $pointsCols[$col]['points'];
            if ($pointsCol >= $colPoints) {
                $colPoints = $pointsCol;
                $slot = $emptySlot;
                /**
                 * @var string $colRule
                 */
                $colRule = $pointsCols[$col]['rule'];
            }
        }
        if ($inverted) {
            return [
                'col-rule' => $rowRule,
                'row-rule' => $colRule,
                'slot' => [$slot[1], $slot[0]]
            ];
        }
        return [
            'col-rule' => $colRule,
            'row-rule' => $rowRule,
            'slot' => $slot
        ];
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return  array<string,array<int,array<string,int|string>>|int|string>
     */
    public function points(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = 0;
        $rules = $this->rules;
        $ruleCount = count($rules);

        for ($j = 0; $j <= 5; $j++) {
            $handRule = "";
            $handPoints = 0;
            for ($i = 0; $i < $ruleCount; $i++) {
                $rule = $rules[$i];
                /**
                 * @var RuleStatInterface $possible
                 */
                $possible = $rule['possible'];
                $possibleWhenEmpty = $possible->check([], $deck, $card);

                if ($handPoints === 0) {
                    $data = $this->checkSingleRule($hands, $j, $deck, $card, $rule, $possibleWhenEmpty);
                    $handPoints = $data['points'];
                    $handRule = $data['rule'];
                    if ($handPoints >= $maxPoints) {
                        $maxPoints = $handPoints;
                        $bestHand = $j;
                    }
                }
            }
            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
        }
        return [
            'max' => $maxPoints,
            'bestHand' => $bestHand,
            'points' => $pointsHands
        ];
    }

    /**
     * @param array<array<string>> $rows
     * @param array<string> $deck
     * @return array<string,array<int,int>|int|string>
     */
    public function suggestion(array $rows, string $card, array $deck): array
    {
        // /**
        //  * @var array<array<string,string|RuleStatInterface>> $rules
        //  */
        // $rules = $this->rules->getRules();

        /**
         * @var array<array<string>> $cols
         */
        $cols = $this->colGetter->all($rows);

        $rowData = $this->points($rows, $deck, $card);
        $colData = $this->points($cols, $deck, $card);
        $maxRowPoints = $rowData['max'];
        $maxColPoints = $colData['max'];
        /**
         * @var int $bestRow;
         */
        $bestRow = $rowData['bestHand'];
        /**
         * @var int $bestCol;
         */
        $bestCol = $colData['bestHand'];
        /**
         * @var array<int,array<string,int|string>> $pointsRows
         */
        $pointsRows = $rowData['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsCols
         */
        $pointsCols = $colData['points'];

        if ($maxRowPoints > $maxColPoints) {
            return $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
        }
        return $this->slot($pointsCols, $pointsRows, $bestCol, $cols);
    }
}
