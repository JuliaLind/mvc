<?php

namespace App\ProjectRules;

trait CheckWithCardTrait
{
    use PointsAndRuleNameTrait;
    use PointsAndRuleNameTrait2;

    /**
     * @var array<RuleInterface> $rules
     */
    private array $rules;

    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @return array<string,string|float|int>
     */
    private function checkSingleRuleWith(
        array $hands,
        int $index,
        array $deck,
        string $card,
        RuleInterface $rule,
    ): array {
        if (array_key_exists($index, $hands)) {
            return $this->pointsAndName($hands[$index], $deck, $card, $rule);
        }
        return $this->pointsAndNameEmptyHand($deck, $card, $rule);
    }

    /**
     * Calculates and returns name and number of points (adjusted/weighted)
     * for the best rule possible to achieve with the dealt card, cards
     * in the hand (row or column) and the cards the user is yet to pick from
     * the deck
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|float|int>
     */
    private function handRuleWith(array $hands, int $index, array $deck, string $card)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;

        foreach ($rules as $rule) {
            $data = $this->checkSingleRuleWith($hands, $index, $deck, $card, $rule);
            $name = $data['rule'];
            if ($name != "") {
                break;
            }
            // $handPoints = $data['points'];
            // if ($handPoints > 1) {
            //     break;
            // }
        }
        return $data;
    }
}
