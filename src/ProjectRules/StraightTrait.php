<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if a Straight can be scored in a partially
 * filled or an empty hand (separate methods) without the dealt card.
 * From kmom10/Project
 */
trait StraightTrait
{
    use MinRankLimitsTrait;
    use StraightTrait3;

    /**
     * From CountByRankTrait.
     *
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;


    /**
     * @param array<string> $hand
     * @param array<string> $deck - cards that will be dealt to the player during the remaining game
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        $ranks = $this->countByRank($hand);

        $maxRank = max(array_keys($ranks));
        $minRank = min(array_keys($ranks));

        if (count($hand) > count($ranks) || $maxRank - $minRank > 4) {
            return false;
        }

        $minRankLimits = $this->minRankLimits($minRank, $maxRank);
        $minMinRank = $minRankLimits['min'];
        $maxMinRank = $minRankLimits['max'];
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);
        return $this->checkAllPossible(array_keys($ranksAll), $minMinRank, $maxMinRank);
    }

    /**
     * @param array<string> $deck - cards that will be dealt to the player during the remaining game
     */
    public function possibleDeckOnly(array $deck): bool
    {
        $ranks = $this->countByRank($deck);
        $minMinRank = min(array_keys($ranks));
        $maxMinRank = max(array_keys($ranks)) - 4;
        return $this->checkAllPossible(array_keys($ranks), $minMinRank, $maxMinRank);
    }
}
