<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


use App\ProjectGrid\Grid;

trait FinalResultsTrait
{
    /**
     * From CheckFullHandTrait
     *
     * Checks which rule is scored at best (if any)
     * for a full hand. Called when the grid is completely filled.
     * Returns name of the scored rule and the number of poitns (actual, not weighted/adjusted)
     * @param array<string> $hand
     * @return array<string,string|int>
     */
    abstract private function checkHandForWin($hand): array;

    /**
     * Returns results for all five hands in one direction (horizontal
     * or vetical)
     * @param array<array<string>> $hands
     * @return array<string,array<array<string,int|string>>|int>
     */
    private function resultsOneDirection(array $hands): array {
        $data = [];
        $total = 0;
        /**
         * @var int $index
         */
        foreach($hands as $index => $hand) {
            /**
             * @var array<string,string|int> $data
             */
            $handResult = $this->checkHandForWin($hand);
            /**
             * @var string $name
             */
            $name = $handResult['name'];
            $data[$index]['name'] = $name;
            /**
             * @var int $points
             */
            $points = $handResult['points'];
            $total += $points;
            $data[$index]['points'] = $points;
        }
        return [
            'data' => $data,
            'total' => $total
        ];
    }

    /**
     * Calculates and returns for each hand (horizontally and vertically)
     * the highest score rule and points for that rule, and the total points
     * for all the hands
     * @return array<string,array<array<string,int|string>>|int>
     */
    public function results(Grid $grid): array
    {
        $result = [];
        $total = 0;

        $hands = [
            'rows' => $grid->getRows(),
            'cols' => $grid->getCols()
        ];
        /**
         * @var string $direction
         * @var array<array<string>> $handArray
         */
        foreach($hands as $direction => $handArray) {
            $data = $this->resultsOneDirection($handArray);
            $result[$direction] = $data['data'];
            /**
             * @var int $pointsDirection
             */
            $pointsDirection = $data['total'];
            $total += $pointsDirection;
        }
        $result['total'] = $total;
        return $result;
    }
}
