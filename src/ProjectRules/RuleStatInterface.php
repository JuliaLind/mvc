<?php

namespace App\ProjectRules;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleStatInterface
{
    /**
     * Returns true if the rule is possible to score if placing the
     * card in the hand, otherwise returns false. Starting position is that none
     * of the higher rules can be scored
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithCard(array $hand, array $deck, string $card): bool;

    /**
     * Returns true if the rule is possible to score without the card
     * based on only cards in hand and the possible cards from deck,
     * Starting position is that none
     * of the higher rules can be scored
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool;

    /**
     * Returns true if the rule is possible to score for an empty hand (calculation
     * based only on the possible cards from deck). Starting position is that none
     * of the higher rules can be scored
     * @param array<string> $deck
     * @return bool
     */
    public function possibleDeckOnly(array $deck);

    /**
     * Returns additional value (1 for each
     * card already in hand that contributes to fulfilling
     * the rule, used for determining the suggested slot)
     */
    public function getAdditionalValue(): int;
}
