<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightStatTrait;

    // protected string $suit;

    // /**
    //  * @param array<Card> $cards
    //  */
    // protected function checkForCards($cards, int $minRank): bool
    // {
    //     $maxRank = $minRank + 4;
    //     $suit = $this->suit;
    //     $searcher = $this->searcher;
    //     for ($rank = $minRank; $rank <= $maxRank; $rank++) {
    //         if ($searcher->search($cards, $rank, $suit) === false) {
    //             return false;
    //         }
    //     }
    //     return true;
    // }


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
