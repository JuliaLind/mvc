<?php

namespace App\ProjectRules;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait BestPossibleRulesTrait
{
    use CheckWithCardTrait;
    use CheckWithoutCardTrait;

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    private function rulesHands(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = 0;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->handRuleWith($hands, $j, $deck, $card);
            /**
             * @var float $handPoints
             */
            $handPoints = $data['points'];
            $handRule = $data['rule'];
            $handRuleWithout = $this->handRuleWithout($hands, $j, $deck);

            /**
             * To en sure that aiming for a pair or two
             * pairs will not destroy the chances of getting one
             * of the better rules if there are completely empty rows
             * available (empty rows have a value of 0.5)
             */
            $notPrioritized = ["One Pair", "Two Pairs", ""];
            if(in_array($handRule, $notPrioritized, true) && !in_array($handRuleWithout, $notPrioritized, true)) {
                $handPoints = $handPoints * 0.01;
            }
            if ($handPoints >= $maxPoints) {
                $maxPoints = $handPoints;
                $bestHand = $j;
            }

            $pointsHands[$j]['rule'] = $handRule;
            $pointsHands[$j]['points'] = $handPoints;
            $pointsHands[$j]['rule-without'] =  $handRuleWithout;
        }
        return [
            'max' => $maxPoints,
            'bestHand' => $bestHand,
            'allRules' => $pointsHands,
        ];
    }
}
