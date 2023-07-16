<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Checks if flush is possible to score in an empty hand, without the dealt card.
 * From kmom10/Project
 */
trait FlushTrait2
{
    /**
     * @param array<string> $cards
     * @return array<string,int>
     */
    abstract private function countBySuit(array $cards): array;

    /**
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($deck);
        return max($suits) >= 5;
    }
}
