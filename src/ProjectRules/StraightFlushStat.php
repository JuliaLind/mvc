<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait;
    use SameSuitTrait;

    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, Card $card): bool
    {
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($newHand);

        $allCards = array_merge($newHand, $deck);
        return $this->setSuit($uniqueCountHand) && $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }
}
