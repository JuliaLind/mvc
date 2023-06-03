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
class RoyalFlushStat implements RuleStatInterface
{
    use RuleTrait;

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

    private CardSearcher $searcher;

    public function __construct(
        CardCounter $cardCounter = new CardCounter(),
        CardSearcher $searcher = new CardSearcher()
    ) {
        $this->cardCounter = $cardCounter;
        $this->searcher = $searcher;
    }

    /**
     * @param array<Card> $hand
     */
    private function checkForScore($hand, RoyalFlush $rule=new RoyalFlush()): bool
    {
        $scored =  $rule->scored($hand);
        /**
         * @var bool $possible
         */
        $possible = $scored['scored'];
        return $possible;
    }

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
        // if (count($hand) === 5) {
        //     return false;
        // }
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];
        if (count($newHand) === 5) {
            return $this->checkForScore($newHand);
        }

        $uniqueCountHand = $this->cardCounter->count($newHand);
        /**
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (count($suitsHand) > self::UNIQUESUITS || min(array_keys($ranksHand)) < self::MINRANK) {
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
