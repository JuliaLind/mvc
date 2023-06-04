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
    // use RuleTrait;

    /**
     * @var int $MAXRANK corresponds to Ace
     */
    private const MAXRANK = 14;

    /**
     * @var int $MINRANK corresponds to Ten
     */
    private const MINRANK = 10;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    // private CardSearcher $searcher;

    // public function __construct(
    //     CardCounter $cardCounter = new CardCounter(),
    //     CardSearcher $searcher = new CardSearcher()
    // ) {
    //     $this->cardCounter = $cardCounter;
    //     $this->searcher = $searcher;
    // }

    /**
     * @param array<Card> $cards
     * @param string $suit
     */
    private function checkForCards($cards, $suit): bool
    {
        $possible = true;
        $searcher = $this->searcher;
        for ($rank = self::MINRANK; $rank <= self::MAXRANK; $rank++) {
            $possible = $searcher->search($cards, $rank, $suit);
            if ($possible === false) {
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
    public function possible(array $hand, array $deck, Card $card): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);
        /**
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];
        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (count($suitsHand) > self::UNIQUESUITS || min(array_keys($ranksHand)) < self::MINRANK || $card->getSuit() != $suit || $card->getRank() <= self::MINRANK) {
            return false;
        }
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];
        $allCards = array_merge($newHand, $deck);
        return $this->checkForCards($allCards, $suit);
    }
}
