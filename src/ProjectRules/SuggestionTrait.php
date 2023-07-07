<?php

namespace App\ProjectRules;

use App\ProjectGrid\Grid;
use App\Project\NoCardsException;

trait SuggestionTrait
{
    use BestPossibleRulesTrait;
    use CheckEmptyGridTrait;
    use EmptyCellTrait;
    use ExtractRuleNamesTrait;
    use SlotTrait;


    /**
     * From RowsToColsTrait
     *
     * Returns a two-dimensional array
     * wich correspons to an "inverted version" of the grid,
     * (i.e. an array with vertical hands)
     * @param array<array<string>> $rows
     * @return array<array<string>>
     */
    abstract private function getCols($rows): array;

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

        if ($deck === []) {
            return [
                'col-rule' => "",
                'row-rule' => "",
                'slot' => $this->oneEmpty($grid),
                'row-rules-with-card' => ["", "", "", "", ""],
                'row-rules-without-card' => ["", "", "", "", ""],
                'col-rules-with-card' => ["", "" ,"", "", ""],
                'col-rules-without-card' => ["", "" ,"", "", ""]
            ];
        }

        // $cols = $grid->getCols();
        $cols = $this->getCols($rows);

        $rowData = $this->rulesHands($rows, $deck, $card);
        $colData = $this->rulesHands($cols, $deck, $card);

        // /**
        //  * @var int|float $maxRowPoints
        //  */
        // $maxRowPoints = $rowData['max'];
        // /**
        //  * @var int|float $maxColPoints
        //  */
        // $maxColPoints = $colData['max'];
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


        $slot1 = $this->bestSlot($rulesRows, $rulesCols, $bestRow, $rows);
        /**
         * @var int $totPoints1
         */
        $totPoints1 = $slot1['tot-weight-points-slot'];

        $slot2 = $this->bestSlot($rulesCols, $rulesRows, $bestCol, $cols, true);
        /**
         * @var int $totPoints2
         */
        $totPoints2 = $slot2['tot-weight-points-slot'];

        $data = $slot1;
        if ($totPoints2 > $totPoints1) {
            $data = $slot2;
        }
        $data = array_merge($data, $handRules);
        return $data;

        // if ($maxRowPoints >= $maxColPoints) {
        //     $data = $this->slot($rulesRows, $rulesCols, $bestRow, $rows);
        //     $data = array_merge($data, $handRules);
        //     return $data;
        // }
        // $data = $this->slot($rulesCols, $rulesRows, $bestCol, $cols, true);
        // $data = array_merge($data, $handRules);
        // return $data;
    }
}
