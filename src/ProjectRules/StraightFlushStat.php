<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    protected int $maxRank = 1;

    /**
     * @var int $MINRANK corresponds to Ten
     */
    protected int $minRank = 15;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    /**
     * @param array<int,int> $ranks
     */
    private function setRankLimits(array $ranks): bool
    {
        foreach($ranks as $rank) {
            if ($rank > $this->maxRank) {
                $this->maxRank = $rank;
            }
            if ($rank < $this->minRank) {
                $this->minRank = $rank;
            }
            if ($this->maxRank - $this->minRank > 4) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array<Card> $cards
     * @param string $suit
     */
    private function checkForCards($cards, $suit): bool
    {
        $possible = true;
        $searcher = $this->searcher;
        for ($rank = $this->minRank; $rank <= $this->maxRank; $rank++) {
            $possible = $searcher->search($cards, $rank, $suit);
            if ($possible === false) {
                break;
            }
        }
        return $possible;
    }

    /**
     * @param array<Card> $cards
     * @param string $suit
     */
    private function checkAllPossible($cards, $suit): bool
    {
        $possible = false;
        $minMinRank = $this->minRank - 4;
        $maxMinRank = $this->minRank;
        for ($this->minRank = $minMinRank; $this->minRank <= $maxMinRank; $this->minRank++) {
            $this->maxRank = $this->minRank + 4;
            if ($this->checkForCards($cards, $suit) === true) {
                return true;
            }
            // for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            //     $possible = $searcher->search($cards, $rank, $suit);
            //     if ($possible === false) {
            //         break;
            //     }
            // }
        }
        // for ($minRank = $this->maxRank - 4; $minRank <= $this->minRank; $minRank++) {
        //     $maxRank = $minRank + 4;
        //     for ($rank = $minRank; $rank <= $maxRank; $rank++) {
        //         $possible = $searcher->search($cards, $rank, $suit);
        //         if ($possible === false) {
        //             break;
        //         }
        //     }
        // }
        return $possible;
    }

    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function possible(array $hand, array $deck, Card $card): bool
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

        if (count($suitsHand) > self::UNIQUESUITS) {
            return false;
        }

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        if ($this->setRankLimits($ranksHand) === false) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $allCards = array_merge($newHand, $deck);
        return $this->checkAllPossible($allCards, $suit);
    }
}
