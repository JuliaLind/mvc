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
     * @var array<Card> $hand
     */
    protected array $hand;
    /**
     * @var array<int,int> $ranksHand
     */
    protected array $ranksHand;

    abstract protected function checkCountRanks(): bool;

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

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $this->ranksHand = $ranksHand;
        $this->hand = $hand;
        $rank = $card->getRank();
        $this->rank = $rank;

        /**
         * @var array<Card> $allCards
         */
        $allCards = array_merge([...$hand, $card], $deck);

        return array_key_exists($rank, $ranksHand) && $this->checkCountRanks() && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }
}
