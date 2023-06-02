<?php

namespace App\Project;

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
     * @param array<Card> $cards
     * @return  array<string,array<array<int|string,int>>>
     */
    public function count($cards): array
    {
        $ranks = [];
        $suits = [];
        foreach($cards as $card) {
            $ranks = $this->newCount($card->getRank(), $ranks);
            $suits = $this->newCount($card->getSuit(), $suits);
        }
        return [
            'ranks' => $ranks,
            'suits' => $suits,
        ];
    }
}
