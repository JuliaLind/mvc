<?php

namespace App\ProjectRules;

trait SubCountTrait
{
    /**
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
