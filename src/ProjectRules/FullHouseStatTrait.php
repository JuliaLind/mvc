<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait
{
    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];

        $three = false;
        $two = false;
        foreach ($ranksDeck as $rank) {
            if ($three === false && $rank >= 3) {
                $three = true;
            } elseif ($rank >= 2) {
                $two = true;
            }
            if ($three && $two) {
                return true;
            }
        }
        return false;
    }
}
