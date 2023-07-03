<?php

namespace App\ProjectRules;

trait FullHouseTrait3
{
    // /**
    //  * From FullHouseTrait6
    //  *
    //  * @param bool $three - false if three of the same rank has not been checked before
    //  * @param int $countRank - number of cards of the same rank
    //  * @return bool - returns true if three has not been checked previously and
    //  * the count of a rank is 3 or 4
    //  */
    // abstract private function checkThree(int $three, int $rank): bool;

    /**
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
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($deck);

        $three = 0;
        $two = 0;
        // foreach ($ranks as $rank) {
        //     if ($this->checkThree($three, $rank)) {
        //         $three = 1;
        //     } elseif ($rank >= 2) {
        //         $two = 1;
        //     }
        //     if ($two + $three === 2) {
        //         return true;
        //     }
        // }

        foreach ($ranks as $countRank) {
            if ($three === 0 && $countRank >= 3) {
                $three = 1;
            } elseif ($countRank >= 2) {
                $two = 1;
            }
            if ($two + $three === 2) {
                return true;
            }
        }
        return false;
    }
}
