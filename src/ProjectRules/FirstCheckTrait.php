<?php

namespace App\ProjectRules;

/**
 * Used by the following classes:
 * Flush
 * FullHouse
 * RoyalFlush
 * StraightFlush
 * Straight
 */
trait FirstCheckTrait
{
    use AdditionalValueTrait;

    /**
     * Return true if the rule is possible to score without the dealt card,
     * given the cards in the hand and in the deck.
     * @param array<string> $hand
     * @param array<string> $deck
     */
    abstract public function possibleWithoutCard(array $hand, array $deck): bool;

    /**
     * Returns true if the rule is possible to score if the dealt card is placed in
     * the hand
     * @param array<string> $hand
     * @param array<string> $deck
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
