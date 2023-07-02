<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindTrait3
{
    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        return max($ranksDeck) >= $this->minCountRank;
    }
}
