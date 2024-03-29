<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Trait for checking if the deck contains enough cards of the required suit
 * to be able to achieve a flush in a hand.
 * From kmom10/Project
 */
trait FlushTrait3
{
    /**
     * From CountBySuitTrait.
     *
     * Returns an associative array
     * where keys are the suits present amongst
     * the cards and the values are the count of
     * each suit
     * @param array<string> $cards
     * @return array<string,int>
     */
    abstract private function countBySuit($cards): array;

    /**
     * Used in the following traits:
     * FlushTrait
     *
     * Determins if a Flush is possible
     * to get given cards in hand and cards in deck,
     * i.e. if there are enough cards of the suit to cover
     * fot the unfilled slots in the hand
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    private function checkInDeck(string $suit, array $deck, int $countHand): bool
    {
        $suitsDeck = $this->countBySuit($deck);

        return (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - $countHand));
    }
}
