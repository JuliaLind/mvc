<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MoveEvaluator
{
    private RuleStats $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;
    private string $rowRuleName = "";
    private string $colRuleName = "";
    private string $card;
    /**
     * @var array<string> $deck
     */
    private array $deck;
    private int $rowNr = -1;
    private int $colNr = -1;

    /**
     * @var array<string,string|array<int>> $data
     */
    private array $data;

    public function __construct(
        EmptyCellFinder $finder = new EmptyCellFinder(),
        RuleStats $rules = new RuleStats(),
        ColumnGetter $colGetter = new ColumnGetter()
    ) {
        $this->rules = $rules;
        $this->finder = $finder;
        $this->colGetter = $colGetter;
    }

    /**
     * @param array<array<string>> $rows
     * @param array<array<string>> $cols
     */
    protected function setSlot(int $rowNr, int $ruleNr, array $rows, array $cols): bool
    {
        $finder = $this->finder;

        $rules = $this->rules;
        $deck = $this->deck;
        $card = $this->card;

        /**
         * @var array<array<string,string|RuleStatInterface>> $allRules
         */
        $allRules = $rules->getRules();
        $rule = $allRules[$ruleNr];

        if($rules->checkSingle($rows, $rowNr, $deck, $card, $ruleNr)) {
            $this->rowNr = $rowNr;
            /**
             * @var string $name
             */
            $name = $rule['name'];
            $this->rowRuleName = $name;

            $emptyCells = $finder->single($rows[$rowNr], $rowNr, true);

            $ruleCount = count($allRules);

            for ($i = 0; $i < $ruleCount; $i++) {
                foreach($emptyCells as $cell) {
                    $colNr = $cell[1];
                    $this->colNr = $colNr;
                    if ($rules->checkSingle($cols, $colNr, $deck, $card, $i)) {
                        /**
                         * @var string $name
                         */
                        $name = $allRules[$i]['name'];
                        $this->colRuleName = $name;
                        return true;
                    };
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @param array<array<string>> $rows
     * @param array<array<string>> $cols
     */
    protected function checkRowColForRule(int $index, int $ruleNr, $rows, $cols): bool
    {
        if ($this->setSlot($index, $ruleNr, $rows, $cols)) {
            $this->data = [
                'row-rule' => $this->rowRuleName,
                'col-rule' => $this->colRuleName,
                'slot' => [$this->rowNr, $this->colNr]
            ];
            return true;
        }
        if ($this->setSlot($index, $ruleNr, $cols, $rows)) {
            $this->data = [
                'row-rule' => $this->colRuleName,
                'col-rule' => $this->rowRuleName,
                'slot' => [$this->colNr, $this->rowNr]
            ];
            return true;
        }
        return false;
    }

    /**
     * @param array<array<string>> $rows
     * @param array<string> $deck
     * @return array<string,string|array<int>>
     */
    public function suggestion(array $rows, string $card, array $deck): array
    {
        $ruleCount = 9;
        /**
         * @var array<array<string>> $cols
         */
        $cols = $this->colGetter->all($rows);
        $this->card = $card;
        $this->deck = $deck;

        for ($i = 0; $i < $ruleCount; $i++) {
            for ($j = 0; $j <= 5; $j++) {
                if ($this->checkRowColForRule($j, $i, $rows, $cols)) {
                    return $this->data;
                }
            }
        }
        $data = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => $this->finder->oneCell($rows, $cols)
        ];
        // for ($row = 0; $row <= 4; $row++) {
        //     for ($col = 0; $col <= 4; $col++) {
        //         if (!array_key_exists($row, $rows) && !array_key_exists($col, $cols)) {
        //             $data['slot'] = [$row, $col];
        //             return $data;
        //         }
        //     }
        // }
        // $data['slot'] = $this->finder->all($rows)[0];
        return $data;
    }
}
