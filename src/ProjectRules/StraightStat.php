<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

class StraightStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightStatTrait;

    /**
     * @param array<string> $cards
     */
    protected function checkForCards($cards, int $minRank): bool
    {
        $maxRank = $minRank + 4;

        $ranks = $this->cardCounter->count($cards)['ranks'];

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!array_key_exists($rank, $ranks)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];
        // /**
        //  * @var array<string,array<int,int>> $uniqueCountHand
        //  */
        // $uniqueCountHand = $this->cardCounter->count($newHand);

        // if ((count($newHand) > count($uniqueCountHand['ranks']))) {
        //     return false;
        // }

        // $allCards = array_merge($newHand, $deck);
        // return $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
        return $this->check2($newHand, $deck);
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check2(array $hand, array $deck): bool
    {
        // /**
        //  * @var array<string> $newHand
        //  */
        // $newHand = [...$hand, $card];
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($hand);

        if ((count($hand) > count($uniqueCountHand['ranks']))) {
            return false;
        }

        $allCards = array_merge($hand, $deck);
        return $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }
}
