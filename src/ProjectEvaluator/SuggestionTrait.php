<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;

/**
 * Trait for generating a suggestion on best slot to place the dealt card.
 * Also calculates and returns statistics on the best possible rule that can be achieved with/without
 * the dealt card for all the 10 hands, from kmom10/Project
 */
trait SuggestionTrait
{
    use BestPossibleRulesTrait;
    use CheckEmptyGridTrait;
    use EmptyCellTrait;
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
     * The main method for generating the statistics of possible rules for all ten hands
     * with and without the dealt card and a suggestion of the best slot to place the dealt card
     * @param array<string> $deck - ranks of the cards from the deck that will be dealt to the player in the remaining game
     * @return array<string,array<int,array<string,float|int|string>|int>|int|string>
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function suggestion(Grid $grid, string $card, array $deck): array
    {
        $rows = $grid->getRows();
        if ($rows === []) {
            return $this->emptyGridSuggestion($deck, $card);
        }

        if ($deck === []) {
            $data = [
                'col-rule' => "",
                'row-rule' => "",
                'slot' => $this->oneEmpty($grid),
                'row-rules' => [],
                'col-rules' => [],
            ];

            for ($i = 0; $i <= 4; $i++) {
                $dummyData = [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ];
                $data['row-rules'][] = $dummyData;
                $data['col-rules'][] = $dummyData;
            }
            return $data;
        }

        $cols = $this->getCols($rows);
        $rowData = $this->rulesHands($rows, $deck, $card);
        $colData = $this->rulesHands($cols, $deck, $card);

        /**
         * @var int $bestRow;
         */
        $bestRow = $rowData['bestHand'];
        /**
         * @var int $bestCol;
         */
        $bestCol = $colData['bestHand'];
        /**
         * @var array<int,array<string,float|int|string>> $rulesRows
         */
        $rulesRows = $rowData['allRules'];
        /**
         * @var array<int,array<string,float|int|string>> $rulesCols
         */
        $rulesCols = $colData['allRules'];

        $handRules = [
            'row-rules' => $rulesRows,
            'col-rules' => $rulesCols
        ];

        $slot1 = $this->bestSlot($rulesRows, $rulesCols, $bestRow, $rows);
        /**
         * @var int $totPoints1
         */
        $totPoints1 = $slot1['tot-weight-slot'];

        $slot2 = $this->bestSlot($rulesCols, $rulesRows, $bestCol, $cols, true);
        /**
         * @var int $totPoints2
         */
        $totPoints2 = $slot2['tot-weight-slot'];

        $data = $slot1;
        if ($totPoints2 > $totPoints1) {
            $data = $slot2;
        }
        $data = array_merge($data, $handRules);
        return $data;
    }
}
