<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

trait EmptyCellTrait
{
    /**
    * @param array<string> $hand
    * @return array<array<int,int>>
    */
    private function single(array $hand, int $index): array
    {
        $empty = [];
        for ($col = 0; $col < 5; $col++) {
            if (!array_key_exists($col, $hand)) {
                array_push($empty, [$index, $col]);
            }
        }
        return $empty;
    }
}
