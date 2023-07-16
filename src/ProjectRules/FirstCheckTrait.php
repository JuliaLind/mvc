<?php

namespace App\ProjectRules;

/**
 * Used by the following classes:
 * Flush
 * FullHouse
 * RoyalFlush
 * StraightFlush
 * Straight.
 *
 * First check = check if a rule is possible with the dealt card,
 * for rules where a lot of the logic can be reused from the corresponding
 * method for checking for best possible rule without card. Used in the rules
 * where all five cards are required to score the rule as lot of the possibleWithoutCard logic
 * can be reused in these rules.
 * From kmom10/Project
 */
trait FirstCheckTrait
{
    use AdditionalValueTrait;

    /**
     * Return true if the rule is possible to score without the dealt card,
     * given the cards in the hand and in the deck.
     * @param array<string> $hand
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    abstract public function possibleWithoutCard(array $hand, array $deck): bool;

    /**
     * Returns true if the rule is possible to score if the dealt card is placed in
     * the hand
     * @param array<string> $hand
     * @param array<string> $deck - ranks of the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleWithCard(array $hand, array $deck, string $card): bool
    {
        $this->additionalValue = 0;
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        if ($this->possibleWithoutCard($newHand, $deck)) {
            $this->additionalValue = count($hand);
            return true;
        }
        return false;
    }

}
