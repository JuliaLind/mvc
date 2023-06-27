<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait2
{
    use FullHouseStatTrait;
    use FullHouseStatTrait6;
    use FullHouseStatTrait7;


    /**
     * @param array<string> $deck
     */
    abstract public function check3(array $deck): bool;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];
        $allCards = array_merge($hand, $deck);
        $uniqueCountAllCards = $this->cardCounter->count($allCards);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $uniqueCountAllCards['ranks'];

        if (count($hand) === 1) {
            $rank = array_keys($ranksHand)[0];
            return in_array($rank, array_keys($ranksDeck)) && $this->check3($allCards);
        }
        return $this->subCheck3($ranksHand, $ranksDeck) || ($this->subCheck2($ranksHand) && $this->subCheck($ranksHand, $ranksAll));
    }
}
