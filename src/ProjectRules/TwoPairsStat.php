<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    use TwoPairsTrait;
    use TwoPairsStatTrait;


    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) < 4) {
            return array_key_exists($rank, $ranksHand) || array_key_exists($rank, $ranksDeck);
        }
        return array_key_exists($rank, $ranksHand);
    }

    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) === 1) {
            /**
             * @var int $maxRankDeck
             */
            $maxRankDeck = max($ranksDeck);
            if ((array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2) || (array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck))) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (array_key_exists($rank, $ranksHand)) {
            foreach($ranksHand as $rank2) {
                if (array_key_exists($rank2, $ranksDeck)) {
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
    public function check(array $hand, array $deck, string $card): bool
    {

        $rank = intval(substr($card, 0, -1));
        $uniqueCountHand = $this->cardCounter->count($hand);
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];

        if (count($hand) > count($ranksHand)) {
            return $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        }
        if (count($hand) === count($ranksHand)) {
            return $this->subCheck2($hand, $rank, $ranksHand, $ranksDeck) || $this->subCheck3($rank, $ranksHand, $ranksDeck);
        }
        return false;
    }
}
