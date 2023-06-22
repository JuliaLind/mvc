<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

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
     * @var array<string> $hand
     */
    protected array $hand;

    /**
     * @var array<int,int> $ranksHand
     */
    protected array $ranksHand;

    abstract protected function checkCountRanks(): bool;


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $this->ranksHand = $ranksHand;
        $this->hand = $hand;
        $rank = intval(substr($card, 0, -1));
        $this->rank = $rank;

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge([...$hand, $card], $deck);

        return array_key_exists($rank, $ranksHand) && $this->checkCountRanks() && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check2(array $hand, array $deck): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $this->ranksHand = $ranksHand;
        $this->hand = $hand;

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge($hand, $deck);

        $check = false;
        foreach(array_keys($ranksHand) as $rank) {
            $this->rank = $rank;
            $check = $this->checkCountRanks() && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
            if ($check === true) {
                break;
            }
        }
        return $check;
    }
}
