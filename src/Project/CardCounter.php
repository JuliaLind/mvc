<?php

namespace App\Project;

/**
 * Class for counting cards
 *
 */
class CardCounter
{
    /**
     * @param array<Card|null> $cards
     */
    public function cardCount(array $cards): int
    {
        return count($cards);
    }
}
