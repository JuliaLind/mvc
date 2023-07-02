<?php

namespace App\ProjectRules;

trait FullHouseStatTrait2
{
    /**
     * @param array<string> $deck
     */
    abstract public function possibleDeckOnly(array $deck): bool;

    abstract private function subCheck($ranksHand, $ranksAll): bool;
    /**
     * @param array<int,int> $ranksHand
     */
    abstract private function subCheck2($ranksHand): bool;
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck3($ranksHand, $ranksDeck): bool;
    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);

        if (count($hand) === 1) {
            $rank = array_key_first($ranksHand);
            return in_array($rank, array_keys($ranksDeck)) && $this->possibleDeckOnly($allCards);
        }
        return $this->subCheck3($ranksHand, $ranksDeck) || ($this->subCheck2($ranksHand) && $this->subCheck($ranksHand, $ranksAll));
    }
}
