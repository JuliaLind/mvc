<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    // use SameRankStatTrait;

    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    protected int $minCountRank;
    protected int $rank;

    /**
     * Constructor
     */
    public function __construct(int $minCountRank=2)
    {
        parent::__construct();
        $this->minCountRank = $minCountRank;
    }

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
        $rank = intval(substr($card, 0, -1));
        $this->rank = $rank;

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge([...$hand, $card], $deck);

        return (array_key_exists($rank, $ranksHand) && count($hand) > count($ranksHand) && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank)) || (count($ranksHand) == 0 && $this->checkInDeck($deck, $rank));
    }

    /**
     * @param array<string> $deck
     */
    public function checkInDeck(array $deck, int $rank): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];
        if (array_key_exists($rank, $ranksDeck)) {
            foreach($ranksDeck as $rank2 => $count) {
                if ($rank2 != $rank && $count >= 2) {
                    return true;
                }
            }
        }
        return false;
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

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge($hand, $deck);

        $check = false;
        foreach(array_keys($ranksHand) as $rank) {
            $this->rank = $rank;
            $check = count($hand) > count($ranksHand) && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
            if ($check === true) {
                break;
            }
        }
        return $check;
    }
}
