<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FullHouseTrait
{
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        /**
        * @var array<int,int> $ranks
        */
        $ranks = $this->countByRank($hand);

        return count($ranks) === 2 && max($ranks) === 3;
    }
}
