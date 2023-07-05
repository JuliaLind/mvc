<?php

namespace App\ProjectRules;

use App\ProjectGrid\Grid;

trait SuggestionTrait
{
    use BestPossibleRulesTrait;
    use CheckEmptyGridTrait;
    use EmptyCellTrait;
    use ExtractRuleNamesTrait;
    use SlotTrait;


    /**
     * @param array<string> $deck
     * @return array<string,array<int|string>|int|string>array<string,array<int,int>|int|string>
     */
    public function suggestion(Grid $grid, string $card, array $deck): array
    {
        $rows = $grid->getRows();
        if ($rows === []) {
            return $this->emptyGridSuggestion($deck, $card);
        }
        $cols = $grid->getCols();

        $rowData = $this->rulesHands($rows, $deck, $card);
        $colData = $this->rulesHands($cols, $deck, $card);

        /**
         * @var int|float $maxRowPoints
         */
        $maxRowPoints = $rowData['max'];
        /**
         * @var int|float $maxColPoints
         */
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
         * @var array<int,array<string,int|string>> $rulesRows
         */
        $rulesRows = $rowData['allRules'];
        /**
         * @var array<int,array<string,int|string>> $rulesCols
         */
        $rulesCols = $colData['allRules'];


        $handRules = $this->extractRuleNames($rulesRows, $rulesCols);


        if ($maxRowPoints >= $maxColPoints) {
            $data = $this->slot($rulesRows, $rulesCols, $bestRow, $rows);
            $data = array_merge($data, $handRules);
            return $data;
        }
        $data = $this->slot($rulesCols, $rulesRows, $bestCol, $cols, true);
        $data = array_merge($data, $handRules);
        return $data;
    }
}
