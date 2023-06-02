<?php

namespace App\Project;

/**
 * Class that searches for a specific card in an aray of cards
 *
 */
class CardSearcher
{
    /**
     * @param array<Card> $cards,
     * @param int $rank
     * @param string $suit
     */
    public function search(array $cards, int $rank, string $suit): bool
    {
        foreach($cards as $card) {
            if ($card->getRank() === $rank && $card->getSuit() === $suit) {
                return true;
            }
        }
        return false;
    }
}
