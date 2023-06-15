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
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($newHand);

        $allCards = array_merge($newHand, $deck);
        return $this->setSuit($uniqueCountHand) && $this->checkRank($uniqueCountHand) && $this->checkForCards($allCards, $this->minRank);
    }
}
