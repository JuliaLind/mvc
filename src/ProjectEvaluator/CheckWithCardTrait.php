<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

/**
 * Used in BestPossibleRulesTrait
 *
 * Checks a hand for the best possible rule
 * to achieve with the dealt card, from kmom10/Project
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait CheckWithCardTrait
{
    use PointsAndRuleNameTrait;
    use PointsAndRuleNameTrait2;

    /**
     * @var array<RuleInterface> $rules
     */
    private array $rules;


    /**
     * Returns the name and weighted* points if the rule is
     * possible rule to achieve for the hand on index-position
     * $index with the dealt card and the cards
     * that ill be dealt from deck
     * @param array<string> $deck reminaing cards that will be dealt to user from deck
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
     * for the best rule possible to achieve with the dealt card,
     * the cards the user is yet to pick from the deck
     * and the cards in hand on index position $index
     * @param array<array<string>> $hands five hands, horizontal or vertical
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     * @return array<string,string|float|int>
     *
     */
    private function handRuleWith(array $hands, int $index, array $deck, string $card)
    {
        $data = [
            'weight' => 0,
            'rule-with-card' => ""
        ];
        $rules = $this->rules;
        foreach ($rules as $rule) {
            $data = $this->checkSingleRuleWith($hands, $index, $deck, $card, $rule);
            $name = $data['rule-with-card'];
            if ($name != "") {
                break;
            }
        }
        return $data;
    }
}
