<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;

class StraightFlushStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait;
    use SameSuitTrait;

    protected CardSearcher $searcher;
    protected CardCounter $cardCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter(),
        CardSearcher $searcher = new CardSearcher()
    ) {
        $this->cardCounter = $cardCounter;
        $this->searcher = $searcher;
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        return $this->check2($newHand, $deck);
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($hand);

        $allCards = array_merge($hand, $deck);
        return $this->setSuit($uniqueCountHand) && $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }


    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->cardCounter->groupBySuit($deck);
        foreach($cardsBySuit as $suit => $rankArr) {
            $this->suit = $suit;
            if (count($rankArr) >= 5) {
                $this->minRank = min($rankArr);
                $this->maxRank = max($rankArr);
                if ($this->checkAllPossible($deck) === true) {
                    return true;
                }
            }
        }
        return false;
    }
}
