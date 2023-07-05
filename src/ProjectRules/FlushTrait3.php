<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

trait FlushTrait3
{
    // private string $suit;

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

    // /**
    //  * Used in the following traits:
    //  * FlushTrait
    //  *
    //  * Determins if a Flush is possible
    //  * to get given cards in hand and cards in deck,
    //  * i.e. if there are enough cards of the suit to cover
    //  * fot the unfilled slots in the hand
    //  * @param array<string> $deck
    //  * @param array<string> $newHand
    //  */
    // private function checkInDeck(string $suit, array $deck, array $newHand): bool
    /**
     * Used in the following traits:
     * FlushTrait
     *
     * Determins if a Flush is possible
     * to get given cards in hand and cards in deck,
     * i.e. if there are enough cards of the suit to cover
     * fot the unfilled slots in the hand
     * @param array<string> $deck
     */
    private function checkInDeck(string $suit, array $deck, int $countHand): bool
    {
        $suitsDeck = $this->countBySuit($deck);
        // /**
        //  * @var string $suit
        //  */
        // $suit = $this->suit;

        return (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - $countHand));
    }
}
