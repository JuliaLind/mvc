<?php

namespace App\ProjectRules;

class StraightStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightStatTrait;

    /**
     * @param array<string> $cards
     */
    protected function checkForCards($cards, int $minRank): bool
    {
        $maxRank = $minRank + 4;

        $ranks = $this->cardCounter->count($cards)['ranks'];

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!array_key_exists($rank, $ranks)) {
                return false;
            }
        }
        return true;
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

        if ((count($hand) > count($uniqueCountHand['ranks']))) {
            return false;
        }

        $allCards = array_merge($hand, $deck);
        return $this->setRankLimits($uniqueCountHand) && $this->checkAllPossible($allCards);
    }

    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        if ($deck === []) {
            return false;
        }
        /**
         * @var array<string,array<int,int>> $uniqueCountDeck
         */
        $uniqueCountDeck = $this->cardCounter->count($deck);
        $ranksDeck = $uniqueCountDeck['ranks'];
        $this->minRank = min(array_keys($ranksDeck));
        $this->maxRank = max(array_keys($ranksDeck));
        return $this->checkAllPossible($deck);
    }
}
