<?php

namespace App\Project;

/**
 * Class for counting cards
 *
 */
class Counter
{
    /**
     * @SuppressWarnings(PHPMD.ElseExpression)
     * @param array<Card> $cards
     * @return array<int,int>
     */
    public function values($cards): array
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

    /**
     * @param array<Card|null> $cards
     */
    public function cardCount(array $cards): int
    {
        // $count = 0;
        // $cards = $this->cards;
        // for ($i = 0; $i < 5; $i++) {
        //     if ($cards[$i] != null) {
        //         $count++;
        //     }
        // }
        // return $count;
        return count($cards);
    }
}
