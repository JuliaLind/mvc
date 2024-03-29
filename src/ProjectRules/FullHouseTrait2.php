<?php

namespace App\ProjectRules;

/**
 * Trait for checking if Full House rule is possible to score without the
 * dealt card in a partially filled hand.
 * From kmom10/Project
 */
trait FullHouseTrait2
{
    use FullHouseTrait3;
    use FullHouseTrait4;
    use FullHouseTrait5;
    use FullHouseTrait6;

    /**
     * From CountByRankTrait
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
     * Returns true if a rule is possible to score
     * given the cards in the deck and the cards
     * that will be dealt from deck
     * @param array<string> $hand
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);
        if (count($ranksHand) > 2) {
            return false;
        }
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);

        if (count($hand) === 1) {
            $rank = array_key_first($ranksHand);
            return in_array($rank, array_keys($ranksDeck)) && $this->possibleDeckOnly($allCards);
        }

        return $this->check1($ranksHand, $ranksDeck) || ($this->check2($ranksHand) && $this->check3($ranksHand, $ranksAll));
    }
}
