<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;

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
     * @param array<Card> $cards
     */
    protected function checkAllPossible($cards): bool
    {
        $possible = false;
        $minLimits = $this->minRankLimits();
        $minMinRank = $minLimits['min'];
        $maxMinRank = $minLimits['max'];
        for ($minRank = $minMinRank; $minRank <= $maxMinRank; $minRank++) {
            $possible = $this->checkForCards($cards, $minRank);
            if ($possible === true) {
                break;
            }
        }
        return $possible;
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
        $uniqueCountHand = $this->cardCounter->count($newHand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        if ($this->setRankLimits(array_keys($ranksHand)) === false) {
            return false;
        }

        $allCards = array_merge($newHand, $deck);
        return $this->checkAllPossible($allCards);
    }
}
