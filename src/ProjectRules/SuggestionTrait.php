<?php

namespace App\ProjectRules;

use App\ProjectGrid\Grid;

trait SuggestionTrait
{
    /**
     * @param array<string> $deck
     * @return array<string,array<int,int|string>|string>
     */
    abstract private function emptyGridSuggestion(array $deck, string $card);
    /**
     * @param array<int,array<string,int|string>> $rowDataWithCard
     * @param array<int,array<string,int|string>> $colDataWithCard
     * @return array<string,array<int,string>>
     */
    abstract private function extractRuleNames(array $rowDataWithCard, array $colDataWithCard): array;

    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @param array<int,array<string,int|string>> $pointsRows
     * @param array<int,array<string,int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    abstract private function slot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array;

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<int,string>
     */
    abstract private function rulesWithoutCard(array $hands, array $deck): array;
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    abstract private function rulesWithCard(array $hands, array $deck, string $card): array;


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


        $rowData = $this->rulesWithCard($rows, $deck, $card);
        $colData = $this->rulesWithCard($cols, $deck, $card);

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
         * @var array<int,array<string,int|string>> $pointsRows
         */
        $pointsRows = $rowData['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsCols
         */
        $pointsCols = $colData['points'];

        $rowRulesWithout = $this->rulesWithoutCard($rows, $deck);
        $colRulesWithout = $this->rulesWithoutCard($cols, $deck);
        $handRules = $this->extractRuleNames($pointsRows, $pointsCols);
        $handRules['row-rules-without-card'] = $rowRulesWithout;
        $handRules['col-rules-without-card'] = $colRulesWithout;

        if ($maxRowPoints >= $maxColPoints) {
            $data = $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
            $data = array_merge($data, $handRules);
            return $data;
        }
        $data = $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
        $data = array_merge($data, $handRules);
        return $data;
    }
}