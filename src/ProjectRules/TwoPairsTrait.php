<?php

namespace App\ProjectRules;

trait TwoPairsTrait
{
    /**
     * 1 point for every card that already is in hand
     * and contributes to the rule
     */
    private int $additionalValue = 0;

    /**
     * From CountByRankTrait.
     *
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;


    /**
     * From TwoPairsStatTrait4
     * Method called on after ensuring the hand
     * already contains one pair
     * to check if second pair is possible
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool;

    /**
     * From TwoPairsStatTrait5
     * Called on if the hand does not already
     * contains a pair and returns true if the hand
     * contains only 1 card and one of the following is
     * fulfilled:
     * 1. either the card in hand is of same rank as
     * the dealt card and the deck contains at least
     * one pair
     * 2. the deck contains at least one card of the
     * same rank as the card in the hand and at least
     * one card of the same rank as the dealt card
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool;

    /**
     * From TwoPairsStatTrait6
     * Called if the hand does not already contain
     * a pair and checks if the hand contains a card
     * of the same ranks as the dealt card and if the deck
     * contains at least one card of the same rank as any of the
     * cards in deck (note that the deck will not contain
     * the same rank as the dealt card, because otherwise
     * the Three Of A Kind Rule would have already
     * returned true)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck3(int $rank, array $ranksHand, array $ranksDeck): bool;

    /**
     * Checks if the Two Pairs rule if possible to
     * score if card is placed in the hand.
     * Starting point is that none of the higher
     * rules is possible to score
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithCard(array $hand, array $deck, string $card): bool
    {
        $this->additionalValue = 0;

        $rank = intval(substr($card, 0, -1));

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        if (count($hand) > count($ranksHand) && $this->subCheck($hand, $rank, $ranksHand, $ranksDeck)) {
            return $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        }

        if (count($hand) === count($ranksHand) && ($this->subCheck2($hand, $rank, $ranksHand, $ranksDeck) || $this->subCheck3($rank, $ranksHand, $ranksDeck))) {
            $this->additionalValue = 1;
            return true;
        }
        return false;
    }
}
