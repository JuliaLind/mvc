<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

require __DIR__ . "/../../vendor/autoload.php";


trait RankLimitsTrait
{
    protected int $maxRank;
    protected int $minRank;

    /**
     * @param array<string,array<int,int>> $uniqueCountHand
     */
    protected function setRankLimits(array $uniqueCountHand): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $ranks = array_keys($ranksHand);

        $maxRank = max($ranks);
        $minRank = min($ranks);

        $this->maxRank = $maxRank;
        $this->minRank = $minRank;
        return $maxRank - $minRank <= 4;
    }

    /**
     * @return array<string,int>
     */
    protected function minRankLimits(): array
    {
        $minMinRank = $this->maxRank - 4;
        if ($minMinRank < 2) {
            $minMinRank = 2;
        }
        $maxMinRank = $this->minRank;
        if ($maxMinRank > 10) {
            $maxMinRank = 10;
        }
        return [
            'min' => $minMinRank,
            'max' => $maxMinRank
        ];
    }
}
