<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightStatTrait;

    /**
     * @param array<Card> $cards
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
        return $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }
}
