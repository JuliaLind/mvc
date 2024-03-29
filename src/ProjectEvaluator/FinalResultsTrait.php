<?php

namespace App\ProjectEvaluator;

require __DIR__ . "/../../vendor/autoload.php";


use App\ProjectGrid\Grid;

/**
 * Generates final results for a player of PokerSquares Game.
 * Contains methods for generating results for 5 hands in one direction, and for all 10 hands
 * (two directions), from kmom10/project
 */
trait FinalResultsTrait
{
    use CheckFullHandTrait;

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
     * Returns results for all five hands in one direction (horizontal
     * or vetical)
     * @param array<array<string>> $hands
     * @return array<string,array<array<string,int|string>>|int>
     */
    private function resultsOneDirection(array $hands): array
    {
        $data = [];
        $total = 0;

        for ($index = 0; $index <= 4; $index++) {
            $hand = [];
            if (array_key_exists($index, $hands)) {
                /**
                 * @var array<string> $hand
                 */
                $hand = $hands[$index];
            }
            /**
             * @var array<string,string|int> $data
             */
            $handResult = $this->checkHandForWin($hand);
            /**
             * @var string $name
             */
            $name = $handResult['name'];
            /**
             * @var int $points
             */
            $points = $handResult['points'];
            $data[$index]['name'] = $name;
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
     * for all the ten hands
     * @return array<string,array<array<string,int|string>>|int>
     */
    public function results(Grid $grid): array
    {
        $result = [];
        $total = 0;
        $rows = $grid->getRows();
        $hands = [
            'rows' => $rows,
            'cols' => $this->getCols($rows)
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
