<?php

namespace App\ProjectRules;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait RulesWithCardTrait
{
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    abstract private function handRuleWith(array $hands, int $index, array $deck, string $card);

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    private function rulesWithCard(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = 0;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->handRuleWith($hands, $j, $deck, $card);
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
