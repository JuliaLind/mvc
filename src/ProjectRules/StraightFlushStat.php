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
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (count($suitsHand) > 1 || $this->setRankLimits(array_keys($ranksHand)) === false) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $this->suit = $suit;
        $allCards = array_merge($newHand, $deck);
        return $this->checkAllPossible($allCards);
    }
}
