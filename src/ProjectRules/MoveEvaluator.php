<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;
use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MoveEvaluator
{
    private Rules $rules;
    private EmptyCellFinder $finder;
    private string $rowRuleName = "";
    private string $colRuleName = "";
    private Card $card;
    /**
     * @var array<Card> $deck
     */
    private array $deck;
    private int $rowNr = -1;
    private int $colNr = -1;

    public function __construct(EmptyCellFinder $finder = new EmptyCellFinder(), Rules $rules = new Rules())
    {
        $this->rules = $rules;
        $this->finder = $finder;
    }

    /**
     * @param array<array<Card>> $rows
     * @param array<array<Card>> $cols
     */
    protected function setSlot(int $index, int $ruleNr, array $rows, array $cols): bool
    {
        $finder = $this->finder;
        $hand = $rows[$index];
        $rules = $this->rules;
        $deck = $this->deck;
        $card = $this->card;
        /**
         * @var array<array<string,string|int|RuleInterface|RuleStatInterface>> $allRules
         */
        $allRules = $rules->getAll();
        $rule = $allRules[$ruleNr];

        if($rules->checkSingle($hand, $deck, $card, $ruleNr)) {
            $this->rowNr = $index;
            /**
             * @var string $name
             */
            $name = $rule['name'];
            $this->rowRuleName = $name;

            $emptyCells = $finder->single($hand, $index, true);

            $ruleCount = count($allRules);

            for ($i = 0; $i < $ruleCount; $i++) {
                foreach($emptyCells as $cell) {
                    $colNr = $cell[1];
                    $this->colNr = $colNr;
                    if ($rules->checkSingle($cols[$colNr], $deck, $card, $i) === true) {
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
     * @param array<string,array<array<Card>>> $rowsAndCols
     * @param array<Card> $deck
     * @return array<string,string|array<int>>
     */
    public function suggestion(array $rowsAndCols, Card $card, array $deck): array
    {
        $ruleCount = 9;
        /**
         * @var array<array<Card>> $rows
         */
        $rows = $rowsAndCols['rows'];
        /**
         * @var array<array<Card>> $cols
         */
        $cols = $rowsAndCols['cols'];
        $this->card = $card;
        $this->deck = $deck;

        for ($i = 0; $i < $ruleCount; $i++) {
            for ($j = 0; $j <= 5; $j++) {
                if (array_key_exists($j, $rows) && $this->setSlot($j, $i, $rows, $cols)) {
                    return [
                        'rowRuleName' => $this->rowRuleName,
                        'colRuleName' => $this->colRuleName,
                        'slot' => [$this->rowNr, $this->colNr]
                    ];
                }
                if (array_key_exists($j, $cols) && $this->setSlot($j, $i, $cols, $rows)) {
                    return [
                        'rowRuleName' => $this->colRuleName,
                        'colRuleName' => $this->rowRuleName,
                        'slot' => [$this->colNr, $this->rowNr]
                    ];
                }
            }
        }
        return [
            'rowRuleName' => "",
            'colRuleName' => "",
            'slot' => $this->finder->all($rows)[0]
        ];
    }
}
