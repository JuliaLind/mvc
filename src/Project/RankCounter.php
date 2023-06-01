<?php

namespace App\Project;

/**
 * Class for counting cards
 *
 */
class RankCounter
{
    /**
     * @SuppressWarnings(PHPMD.ElseExpression)
     * @param array<Card> $cards
     * @return array<int,int>
     */
    public function ranks($cards): array
    {
        $values = [];
        foreach($cards as $card) {
            $value = $card->getValue();
            if (!array_key_exists($value, $values)) {
                $values[$value] = 1;
            } else {
                $values[$value] += 1;
            }
        }
        return $values;
    }
}
