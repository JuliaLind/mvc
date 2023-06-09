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
    protected int $rank;


    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, Card $card): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);

        $rank = $card->getRank();
        $this->rank = $rank;

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        /**
         * @var array<Card> $allCards
         */
        $allCards = array_merge([...$hand, $card], $deck);
        $searcher = $this->searcher;

        return array_key_exists($rank, $ranksHand) && $this->checkCountRanks($ranksHand, $hand) && $searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }
}
