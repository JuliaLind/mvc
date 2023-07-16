<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait used for One Pair, Three Of A Kind,
 * Four Of A Kind rules. For checking if the rule
 * is possible to score without the dealt card
 * in an empty hand.
 * From Kmom10/Project
 */
trait SameOfAKindTrait3
{
    /**
     * @var int $minCountRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;

    /**
     * From CountByRankTrait
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        return max($ranksDeck) >= $this->minCountRank;
    }
}
