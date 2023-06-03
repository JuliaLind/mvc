<?php

namespace App\ProjectCard;

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

    /**
     * @param array<Card> $cards
     * @param int $rank
     */
    public function searchForRank($cards, $rank): int
    {
        $count = 0;
        foreach(['S', 'D', 'C', 'H'] as $suit) {
            $possible = $this->search($cards, $rank, $suit);
            if ($possible === true) {
                $count += 1;
            }
        }
        return $count;
    }
}
