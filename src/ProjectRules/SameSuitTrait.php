<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameSuitTrait
{
    private string $suit;
    abstract private function countBySuit($cards): array;

    /**
     * Used in the following traits:
     * FlushTrait,
     * StraightFlushTrait
     *
     * Sets suit attribute to the suit of the
     * first card in the hand and
     * returns true if all cards in the hand are
     * of the same suit
     * @param array<string> $hand
     */
    private function setSuit(array $hand): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($hand);
        /**
         * @var string $suit
         */
        $suit = array_key_first($suits);
        $this->suit = $suit;
        return count($suits) === 1;
    }
}
