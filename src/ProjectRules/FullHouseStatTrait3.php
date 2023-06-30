<?php

namespace App\ProjectRules;

trait FullHouseStatTrait3
{
    abstract private function checkThree(bool $three, int $rank): bool;
    abstract private function checkBoth(bool $three, bool $two): bool;
    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($deck);

        $three = false;
        $two = false;
        foreach ($ranks as $rank) {
            if ($this->checkThree($three, $rank)) {
                $three = true;
            } elseif ($rank >= 2) {
                $two = true;
            }
            if ($this->checkBoth($three, $two)) {
                return true;
            }
        }
        return false;
    }
}
