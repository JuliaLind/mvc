<?php

namespace App\ProjectRules;

use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class WinEvaluator
{
    private Rules $rules;
    private ColumnGetter $colGetter;


    public function __construct(
        Rules $rules = new Rules(),
        ColumnGetter $colGetter = new ColumnGetter()
    ) {
        $this->colGetter = $colGetter;
        $this->rules = $rules;
    }

    /**
     * @param array<array<string>> $rows
     * @return array<string,array<array<string,int|string>>|int>
     */
    public function results(array $rows): array
    {
        $result = [];
        $total = 0;
        $hands = [
            'rows' => $rows,
            'cols' => $this->colGetter->all($rows)
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
                $data = $this->rules->checkHandForWin($hand);
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
