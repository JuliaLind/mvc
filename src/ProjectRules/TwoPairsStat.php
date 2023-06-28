<?php

namespace App\ProjectRules;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    use TwoPairsTrait;
    use TwoPairsStatTrait;
    use TwoPairsStatTrait2;
    use TwoPairsStatTrait6;
    use TwoPairsStatTrait7;


    /**
     * @param array<string> $hand
     * @param array<string> $deck
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
