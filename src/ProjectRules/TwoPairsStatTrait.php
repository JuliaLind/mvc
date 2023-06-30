<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait
{
    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;
    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck4($hand, $ranksHand, $ranksDeck): bool;
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck5(array $ranksHand, array $ranksDeck): bool;
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck6(array $ranksHand, array $ranksDeck): bool;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);

        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);


        if (count($hand) > count($ranksHand)) {
            return $this->subCheck4($hand, $ranksHand, $ranksDeck) || $this->subCheck5($ranksHand, $ranksDeck);
        }
        if (count($hand) === 1) {
            return array_key_exists(array_keys($ranksHand)[0], $ranksDeck) && max($ranksDeck) >= 2;
        }
        if (count($hand) <= 3) {
            return $this->subCheck6($ranksHand, $ranksDeck);
        }
        return false;
    }
}
