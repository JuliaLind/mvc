<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindStatTrait
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


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);
        $rank = intval(substr($card, 0, -1));


        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge([...$hand, $card], $deck);

        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll= $this->countByRank($allCards);

        return ((array_key_exists($rank, $ranksHand) && $this->subCheck(count($hand), $ranksHand[$rank])) || count($ranksHand) == 0) && $this->subCheck2($ranksAll[$rank]);
    }
}
