<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightStatTrait
{
    /**
     * @return array<string,int>
     */
    abstract protected function minRankLimits(): array;
    /**
     * @param array<string> $cards
     */
    abstract protected function checkForCards($cards, int $minRank): bool;

    /**
     * @param array<string> $cards
     */
    protected function checkAllPossible($cards): bool
    {
        $possible = false;
        $minLimits = $this->minRankLimits();
        $minMinRank = $minLimits['min'];
        $maxMinRank = $minLimits['max'];
        for ($minRank = $minMinRank; $minRank <= $maxMinRank; $minRank++) {
            $possible = $this->checkForCards($cards, $minRank);
            if ($possible) {
                break;
            }
        }
        return $possible;
    }
}
