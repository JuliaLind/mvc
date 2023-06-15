<?php

namespace App\ProjectCard;

/**
 * Class for counting cards
 *
 */
class CardCounter
{
    /**
     * @SuppressWarnings(PHPMD.ElseExpression)
     * @param array<mixed> $arr
     * @return array<array<int|string,int>>
     */
    private function newCount(int|string $value, array $arr): array
    {
        if (!array_key_exists($value, $arr)) {
            $arr[$value] = 1;
        } else {
            $arr[$value] += 1;
        }
        return $arr;
    }


    /**
     * @param array<string> $cards
     * @return  array<string,array<array<int|string,int>>>
     */
    public function count($cards): array
    {
        $ranks = [];
        $suits = [];
        foreach($cards as $card) {
            $ranks = $this->newCount(intval(substr($card, 0, -1)), $ranks);
            $suits = $this->newCount($card[-1], $suits);
        }
        return [
            'ranks' => $ranks,
            'suits' => $suits,
        ];
    }
}
