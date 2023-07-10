<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushScoredTrait
{
    /**
     * From CountBySuitTrait.
     *
     * Returns an associative array
     * where keys are the suits present amongst
     * the cards and the values are the count of
     * each suit
     * @param array<string> $cards
     * @return array<string,int>
     */
    abstract private function countBySuit($cards): array;

    /**
     * Returns true if the Flush rule has been scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        $suitCount = $this->countBySuit($hand);

        return count($hand) === 5 && count($suitCount) === 1;
    }
}
