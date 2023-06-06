<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    protected int $minCountRank = 2;

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

        $uniqueCountHand = $this->cardCounter->count($hand);
        $rank = $card->getRank();

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (!array_key_exists($rank, $ranksHand) && count($ranksHand) > 1 || (5 - count($hand) < $this->minCountRank - $ranksHand[$rank])) {
            return false;
        }

        $check = false;
        foreach($ranksHand as $rankInHand) {
            if ($rankInHand >= 2) {
                $check = true;
                break;
            }
        }
        if ($check === false) {
            return false;
        }
        $allCards = array_merge($newHand, $deck);
        $searcher = $this->searcher;

        return $searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }


    //     /**
    //  * @param array<Card> $hand
    //  * @return bool true if rule is fullfilled otherwise false
    //  */
    // public function check(array $hand): bool
    // {
    //     $bool = false;
    //     $uniqueCount = $this->cardCounter->count($hand);

    //     /**
    //      * @var array<int,int> $uniqueRanks
    //      */
    //     $uniqueRanks = $uniqueCount['ranks'];

    //     $pairs = 0;
    //     foreach($uniqueRanks as $rankCount) {
    //         // the hand should not contain more than 2 of same
    //         // rank because four of a kind and three of a kind
    //         // will be checked before two pairs
    //         if ($rankCount >= 2) {
    //             $pairs += 1;
    //         }
    //         if ($pairs === 2) {
    //             $bool = true;
    //             break;
    //         }
    //     }
    //     return $bool;
    // }
}
