<?php

namespace App\ProjectRules;

/**
 * Trait for checking if Two Pairs rule is possible
 * to score in a hand with the dealt card.
 * From kmom10/Project
 */
trait TwoPairsTrait
{
    use TwoPairsTrait4;
    use TwoPairsTrait5;
    use TwoPairsTrait6;

    /**
     * From CountByRankTrait.
     *
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;


    /**
     * Checks if the Two Pairs rule if possible to
     * score if card is placed in the hand.
     * Starting point is that none of the higher
     * rules is possible to score
     * @param array<string> $hand
     * @param array<string> $deck - cards that will be dealt to the player in the remaining game
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

        if (array_sum($ranksHand) > count($ranksHand)) {
            return $this->check1($rank, $ranksHand, $ranksDeck);
        }

        if (array_sum($ranksHand) === count($ranksHand) && ($this->check3($rank, $ranksHand, $ranksDeck) || $this->check2($rank, $ranksHand, $ranksDeck))) {
            // $this->additionalValue = 1;
            return true;
        }
        return false;
    }
}
