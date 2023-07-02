<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushTrait3
{
    private string $suit;
    abstract private function countBySuit($cards): array;

    /**
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
