<?php

namespace App\ProjectRules;

/**
 * Interface to be implemented by the Poker Squares rules classes.
 * From kmom10/Project
 */
interface RuleInterface
{
    public function getName(): string;
    public function getPoints(): int;

    /**
     * Returns true if the rule is scored,
     * otherwise false. Starting position is that none
     * of the higher rules has been scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool;
    /**
     * Returns true if the rule is possible to score if placing the
     * card in the hand, otherwise returns false. Starting position is that none
     * of the higher rules can be scored
     * @param array<string> $hand
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleWithCard(array $hand, array $deck, string $card): bool;

    /**
     * Returns true if the rule is possible to score without the card
     * based on only cards in hand and the possible cards from deck,
     * Starting position is that none of the higher rules can be scored
     * Note! The hand cannot be empty, for an empty hand the possibleDeckOnly()
     * method should be used
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool;

    /**
     * Returns true if the rule is possible to score for an empty hand (calculation
     * based only on the possible cards from deck). Starting position is that none
     * of the higher rules can be scored
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
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
