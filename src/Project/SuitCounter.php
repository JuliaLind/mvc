<?php

namespace App\Project;

/**
 * Class for counting cards
 *
 */
class SuitCounter
{
    /**
     * @SuppressWarnings(PHPMD.ElseExpression)
     * @param array<Card> $cards
     * @return array<string,int>
     */
    public function suits($cards): array
    {
        $suits = [];
        foreach($cards as $card) {
            $suit = $card->getSuit();
            if (!array_key_exists($suit, $suits)) {
                $suits[$suit] = 1;
            } else {
                $suits[$suit] += 1;
            }
        }
        return $suits;
    }
}
