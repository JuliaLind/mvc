<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

/**
 * Calculates it possible for a hand
 * to score the RoyalFlush rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlushStat extends RuleStat implements RuleStatInterface
{
    use StraightTrait;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    public function __construct()
    {
        parent::__construct();
        $this->maxRank = 14;
        $this->minRank = 10;
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

        if(count($suitsHand) > self::UNIQUESUITS || min(array_keys($ranksHand)) < $this->minRank) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);


        $allCards = array_merge($newHand, $deck);
        return $this->checkForCards($allCards, $suit);
    }
}
