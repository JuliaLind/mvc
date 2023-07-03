<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindTrait2
{
    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;

    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    abstract private function subCheck(int $countHand, int $countRank): bool;
    abstract private function subCheck2(int $rankCount): bool;


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

        $check = false;
        foreach(array_keys($ranksHand) as $rank) {
            $check = $this->subCheck(count($hand), $ranksHand[$rank]) && $this->subCheck2($ranksAll[$rank]);
            if ($check === true) {
                break;
            }
        }
        return $check;
    }
}
