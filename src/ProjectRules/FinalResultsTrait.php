<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


use App\ProjectGrid\Grid;

trait FinalResultsTrait
{
    /**
     * @param array<string> $hand
     * @return array<string,string|int>
     */
    abstract private function checkHandForWin($hand): array;

    /**
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
         * @var string $type
         * @var array<array<string>> $handArray
         */
        foreach($hands as $type => $handArray) {
            foreach($handArray as $index => $hand) {
                /**
                 * @var array<string,string|int> $data
                 */
                $data = $this->checkHandForWin($hand);
                /**
                 * @var string $name
                 */
                $name = $data['name'];
                $result[$type][$index]['name'] = $name;
                /**
                 * @var int $points
                 */
                $points = $data['points'];
                $total += $points;
                $result[$type][$index]['points'] = $points;
            }
        }
        $result['total'] = $total;
        return $result;
    }
}
