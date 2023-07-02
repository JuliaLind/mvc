<?php

namespace App\ProjectRules;

class StraightFlushStat implements RuleStatInterface
{
    use CountByRankTrait;
    use CountBySuitTrait;
    use FirstCheckTrait;
    use GroupBySuitTrait;
    use RankLimitsTrait;
    use SameSuitTrait;
    use SearchSpecificCardTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait3;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        if (!$this->setSuit($hand)) {
            return false;
        }
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($allCards);
        $ranks = $cardsBySuit[$this->suit];

        return $this->setRankLimits($hand) && $this->checkAllPossible($ranks, min($ranks), max($ranks) - 4);
    }


    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($deck);

        foreach($cardsBySuit as $ranks) {
            /**
             * @var array<int> $ranks
             */
            if (count($ranks) >= 5) {
                if ($this->checkAllPossible($ranks, min($ranks), max($ranks) - 4) === true) {
                    return true;
                }
            }
        }
        return false;
    }
}
