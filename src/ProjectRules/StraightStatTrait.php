<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightStatTrait
{
    /**
     * @param array<string> $cards
     */
    abstract private function checkAllPossible($cards, int $minMinRank, int $maxMinRank): bool;

    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $hand
     */
    abstract private function setRankLimits(array $hand): bool;

    /**
     * @return array<string,int>
     */
    abstract private function minRankLimits(): array;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        $ranks = $this->countByRank($hand);

        if ((count($hand) > count($ranks))) {
            return false;
        }
        $check1 = $this->setRankLimits($hand);
        $minRankLimits = $this->minRankLimits();
        $minMinRank = $minRankLimits['min'];
        $maxMinRank = $minRankLimits['max'];
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);
        $check2 = $this->checkAllPossible(array_keys($ranksAll), $minMinRank, $maxMinRank);
        return $check1 && $check2;
    }

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        $ranks = $this->countByRank($deck);
        $minMinRank = min(array_keys($ranks));
        $maxMinRank = max(array_keys($ranks)) - 4;
        return $this->checkAllPossible(array_keys($ranks), $minMinRank, $maxMinRank);
    }
}
