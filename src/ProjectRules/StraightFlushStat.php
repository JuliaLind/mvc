<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait;
    use SameSuitTrait;

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
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($hand);

        $allCards = array_merge($hand, $deck);
        return $this->setSuit($uniqueCountHand) && $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }
}
