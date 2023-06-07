<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait RankLimitsTrait
{
    protected int $maxRank;
    protected int $minRank;

    /**
     * @param array<int,int> $ranks
     */
    protected function setRankLimits(array $ranks): bool
    {
        $maxRank = max($ranks);
        $minRank = min($ranks);
        if ($maxRank - $minRank > 4) {
            return false;
        }
        $this->maxRank = $maxRank;
        $this->minRank = $minRank;
        return true;
        // foreach($ranks as $rank) {
        //     if ($rank > $this->maxRank) {
        //         $this->maxRank = $rank;
        //     }
        //     if ($rank < $this->minRank) {
        //         $this->minRank = $rank;
        //     }
        //     if ($this->maxRank - $this->minRank > 4) {
        //         return false;
        //     }
        // }
        // return true;
    }

}
