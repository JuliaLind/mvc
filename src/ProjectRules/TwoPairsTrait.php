<?php

namespace App\ProjectRules;

trait TwoPairsTrait
{
    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $cards
     */
    public function check3(array $cards): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($cards);

        $pairs = 0;
        foreach ($ranks as $rankCount) {
            if ($rankCount >= 2) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                return true;
            }
        }
        return false;
    }
}
