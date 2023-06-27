<?php

namespace App\ProjectRules;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait EvaluatorTrait6
{
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    abstract public function checkForRule(array $hands, int $index, array $deck, string $card);

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    public function points(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = 0;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->checkForRule($hands, $j, $deck, $card);
            $handPoints = $data['points'];
            $handRule = $data['rule'];
            if ($handPoints >= $maxPoints) {
                $maxPoints = $handPoints;
                $bestHand = $j;
            }
            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
        }
        return [
            'max' => $maxPoints,
            'bestHand' => $bestHand,
            'points' => $pointsHands
        ];
    }
}
