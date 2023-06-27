<?php

namespace App\ProjectRules;

trait FullHouseStatTrait3
{
    abstract private function checkThree(bool $three, int $rank): bool;
    abstract private function checkBoth(bool $three, bool $two): bool;
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
