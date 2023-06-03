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
    private function checkForScore($hand, FourOfAKind $rule=new FourOfAKind()): bool
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
     * @param int $rank
     */
    private function checkForSingle($cards, $rank): bool
    {
        $searcher = $this->searcher;
        $count = $searcher->searchForRank($cards, $rank);
        if ($count == 4) {
            return true;
        }
        return false;
    }

    /**
     * @param array<Card> $cards
     * @param array<int> $ranks
     */
    private function checkForTwo($cards, $ranks): bool
    {
        $check = false;
        foreach($ranks as $rank) {
            $check = $this->checkForSingle($cards, $rank);
            if ($check === true) {
                break;
            }
        }
        return $check;
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
        if (count($hand) === 5) {
            return false;
        }
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];
        $newCountHand = count($newHand);

        if ($newCountHand >= 4 && $this->checkForScore($newHand) === true) {
            return true;
        }

        $uniqueCountHand = $this->cardCounter->count($newHand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $countRanksHand = count($ranksHand);

        if ($countRanksHand > 2 || ($countRanksHand == 2 && min($ranksHand) == 2)) {
            return false;
        }
        $allCards = array_merge($newHand, $deck);
        if ($newCountHand == 2 && $countRanksHand == 2) {
            return $this->checkForTwo($allCards, array_keys($ranksHand));
        }
        /**
         * @var int $rank
         */
        $rank = array_search(max($ranksHand), $ranksHand);
        return $this->checkForSingle($allCards, $rank);
    }
}
