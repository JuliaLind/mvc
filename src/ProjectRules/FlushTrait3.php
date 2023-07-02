<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

trait FlushTrait3
{
    private string $suit;

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
     * FlushTrait,
     *
     * Determins if a Flush is possible
     * to get given cards in hand and cards in deck
     * @param array<string> $deck
     * @param array<string> $newHand
     */
    private function checkInDeck(array $deck, array $newHand): bool
    {
        $suitsDeck = $this->countBySuit($deck);
        /**
         * @var string $suit
         */
        $suit = $this->suit;

        return (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - count($newHand)));
    }
}
