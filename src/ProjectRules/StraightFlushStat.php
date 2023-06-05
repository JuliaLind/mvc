<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    use StraightTrait;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    public function __construct()
    {
        parent::__construct();
        $this->maxRank = 1;
        $this->minRank = 15;
    }

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
        if (count($suitsHand) > self::UNIQUESUITS || $this->setRankLimits($ranksHand) === false) {
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
