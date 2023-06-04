<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class FourOfAKindStat implements RuleStatInterface
{
    use RuleTrait;

    private CardSearcher $searcher;
    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank = 4;

    public function __construct(
        CardCounter $cardCounter = new CardCounter(),
        CardSearcher $searcher = new CardSearcher()
    ) {
        $this->cardCounter = $cardCounter;
        $this->searcher = $searcher;
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
        $newCountHand = count($newHand);

        $uniqueCountHand = $this->cardCounter->count($newHand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $countRanksHand = count($ranksHand);

        if ($countRanksHand > 2 || ($countRanksHand === 2 && min($ranksHand) === 2)) {
            return false;
        }

        $allCards = array_merge($newHand, $deck);
        $searcher = $this->searcher;
        if ($newCountHand === $countRanksHand) {
            return $searcher->checkRanksQuant($allCards, array_keys($ranksHand), $this->minCountRank);
        }
        /**
         * @var int $rank
         */
        $rank = array_search(max($ranksHand), $ranksHand);
        return $searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }
}
