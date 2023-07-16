<?php

namespace App\ProjectRules;

/**
 * Used in:
 * CountByRankTrait,
 * CountBySuitTrait,
 * CountSuitAndRankTrait
 *
 * Returns the count of occurencies of specific value in an array.
 * From kmom10/Project
 */
trait SubCountTrait
{
    /**
     * Counts occurencies of specific value in a array
     * @SuppressWarnings(PHPMD.ElseExpression)
     * @param array<mixed> $arr
     * @return array<array<int|string,int>>
     */
    private function subCount(int|string $value, array $arr): array
    {
        if (!array_key_exists($value, $arr)) {
            $arr[$value] = 1;
        } else {
            $arr[$value] += 1;
        }
        return $arr;
    }
}
