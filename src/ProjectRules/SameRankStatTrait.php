<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait SameRankStatTrait
{
    protected CardCounter $cardCounter;
    protected CardSearcher $searcher;


    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    protected int $minCountRank;


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

        $uniqueCountHand = $this->cardCounter->count($hand);
        $rank = $card->getRank();

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        if (!array_key_exists($rank, $ranksHand) || (5 - count($hand) < $this->minCountRank - $ranksHand[$rank])) {
            return false;
        }
        $allCards = array_merge($newHand, $deck);
        $searcher = $this->searcher;

        return $searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }
}
