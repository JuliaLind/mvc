<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait MinRankLimitsTrait
{
    private int $maxRank;
    private int $minRank;

    /**
     * @return array<string,int>
     */
    private function minRankLimits(): array
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
