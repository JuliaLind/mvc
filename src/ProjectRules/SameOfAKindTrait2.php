<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindTrait2
{
    /**
     * @var int $minCountRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;

    /**
     * From CountByRankTrait
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
     * From SameOfAKindTrait4
     *
     * Returns true if there is enough empty slots left in hand to fit
     * the difference between the count of a rank in the hand and the¨
     * minimum count of same rank required to score the rule
     */
    abstract private function enoughSpaceInHand(int $countHand, int $countRank): bool;

    /**
     * From SameOfAKindTrait4
     *
     * Returns true if the count of rank is the same
     * or exceeds the minimum count of same rank required
     * to score the rule
     */
    abstract private function requiredCount(int $rankCount): bool;


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll= $this->countByRank($allCards);

        $countHand = count($hand);
        if (5 - count($hand) >= $this->minCountRank && max($ranksAll) >= $this->minCountRank) {
            return true;
        }

        foreach(array_keys($ranksHand) as $rank) {
            if ($this->enoughSpaceInHand($countHand, $ranksHand[$rank]) && $this->requiredCount($ranksAll[$rank])) {
                return true;
            }
        }
        return false;
    }
}
