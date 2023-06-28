<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

class SameOfAKindStat implements RuleStatInterface
{
    use SameRankStatTrait;
    use SameRankSingleStatTrait;

    public function __construct(
        int $minCountRank,
        CardCounter $cardCounter = new CardCounter(),
        CardSearcher $searcher = new CardSearcher()
    ) {
        $this->cardCounter = $cardCounter;
        $this->searcher = $searcher;
        $this->minCountRank = $minCountRank;
    }

    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];

        return max($ranksDeck) >= $this->minCountRank;
    }
}
