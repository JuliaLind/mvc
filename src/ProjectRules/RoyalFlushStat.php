<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

/**
 * Calculates it possible for a hand
 * to score the RoyalFlush rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlushStat extends RuleStat implements RuleStatInterface
{
    use StraightFlushStatTrait;
    use SameSuitTrait;

    public function __construct()
    {
        parent::__construct();
        $this->maxRank = 14;
        $this->minRank = 10;
    }

    /**
     * @param array<string,array<int,int>> $uniqueCountHand
     */
    protected function checkRank(array $uniqueCountHand): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        return min(array_keys($ranksHand)) >= $this->minRank;
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

        return $this->check2($newHand, $deck);
    }


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($hand);

        $allCards = array_merge($hand, $deck);

        return $this->setSuit($uniqueCountHand) && $this->checkRank($uniqueCountHand) && $this->checkForCards($allCards, $this->minRank);
    }


    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->cardCounter->groupBySuit($deck);
        foreach($cardsBySuit as $suit => $rankArr) {
            $this->suit = $suit;
            if (count($rankArr) >= 5) {
                if ($this->checkForCards($deck, $this->minRank) === true) {
                    return true;
                }
            }
        }
        return false;
    }
}
