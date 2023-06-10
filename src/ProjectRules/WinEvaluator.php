<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class WinEvaluator
{
    private Rules $rules;

    public function __construct(Rules $rules = new Rules())
    {
        $this->rules = $rules;
    }

    /**
     * @param  array<string,array<array<Card>>> $hands
     * @return  array<string,array<array<string,int|string>>|int>
     */
    public function results(array $hands): array
    {
        // $rules = $this->rules;
        $result = [];
        $total = 0;
        /**
         * @var string $type
         * @var array<array<Card>> $handArray
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
