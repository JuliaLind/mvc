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
     * If the best rule to achieve with card is One Pair,
     * Two Pairs or none, and one of the better rules
     * can be scored in the hand without card, the
     * weighted points are adjusted to prioritize down the hand in relation to
     * the points a rule can give (in this case not taking into account how many of the
     * cards already in hand contribute to the better rule)
     */
    private function adjustPriority(string $ruleWithCard, string $ruleWithoutCard, float $weightPoints, bool $handNotEmpty): float
    {
        /**
         * To en sure that aiming for a pair or two
         * pairs will not destroy the chances of getting one
         * of the better rules if there are completely empty rows
         * available (empty rows have a value of 0.5)
         */
        $notPrioritized = ["One Pair", "Two Pairs", ""];
        $points = [
            'Royal Flush' => 100,
            'Straight Flush' => 75,
            'Four Of A Kind' => 50,
            'Full House' => 25,
            'Flush' => 20,
            'Straight' => 15,
            'Three Of A Kind' => 10
        ];
        if($weightPoints >= 0 && in_array($ruleWithCard, $notPrioritized, true) && !in_array($ruleWithoutCard, $notPrioritized, true)) {
            $weightPoints = 0.5 - 0.01 * $points[$ruleWithoutCard];
            if ($handNotEmpty) {
                /**
                 * Even lower priority if the hand where better
                 * rule is possible already contains cards
                 */
                $weightPoints -= 0.5;
            }
        }
        return round($weightPoints, 2);
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,array<int,array<string,float|int|string>>|float|int|string>
     */
    private function rulesHands(array $hands, array $deck, string $card): array
    {
        $pointsHands = [];
        $bestHand = 0;
        $maxPoints = -200;

        for ($j = 0; $j <= 4; $j++) {
            $data = $this->handRuleWith($hands, $j, $deck, $card);
            /**
             * @var float $handPoints
             */
            $handPoints = $data['points'];
            /**
             * @var string $handRule
             */
            $handRule = $data['rule'];
            /**
             * @var string $handRuleWithout
             */
            $handRuleWithout = $this->handRuleWithout($hands, $j, $deck);

            $handPoints = $this->adjustPriority($handRule, $handRuleWithout, $handPoints, array_key_exists($j, $hands));
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
