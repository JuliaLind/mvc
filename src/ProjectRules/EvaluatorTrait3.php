<?php

namespace App\ProjectRules;

trait EvaluatorTrait3
{
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    abstract public function checkForRule2(array $hands, int $index, array $deck);

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return  array<string,array<int,array<string,int|string>>|int|string>
     */
    public function pointsWithoutCard(array $hands, array $deck): array
    {
        $pointsHands = [];

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->checkForRule2($hands, $j, $deck);
            $handPoints = $data['points'];
            $handRule = $data['rule'];
            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
        }
        return [
            'points' => $pointsHands
        ];
    }

}
