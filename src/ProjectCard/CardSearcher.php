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

    // /**
    //  * @param array<Card> $cards
    //  * @param int $rank
    //  */
    // public function searchForRank($cards, $rank): int
    // {
    //     $count = 0;
    //     foreach(['S', 'D', 'C', 'H'] as $suit) {
    //         $possible = $this->search($cards, $rank, $suit);
    //         if ($possible === true) {
    //             $count += 1;
    //         }
    //     }
    //     return $count;
    // }

    /**
     * @param array<Card> $cards
     * @param int $rank
     * @param int $quantity
     */
    public function checkRankQuant($cards, $rank, $quantity): bool
    {
        $count = 0;
        foreach(['S', 'D', 'C', 'H'] as $suit) {
            $possible = $this->search($cards, $rank, $suit);
            if ($possible === true) {
                $count += 1;
            }
            if ($count == $quantity) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<Card> $cards
     * @param array<int> $ranks
     * @param int $quantity
     */
    public function checkRanksQuant($cards, $ranks, $quantity): bool
    {
        $check = false;
        foreach($ranks as $rank) {
            $check = $this->checkRankQuant($cards, $rank, $quantity);
            if ($check === true) {
                break;
            }
        }
        return $check;
    }
}
