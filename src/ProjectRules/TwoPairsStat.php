<?php

namespace App\ProjectRules;

class TwoPairsStat implements RuleStatInterface
{
    use CountByRankTrait;
    use TwoPairsStatTrait;
    use TwoPairsStatTrait2;
    use TwoPairsStatTrait3;
    use TwoPairsStatTrait4;
    use TwoPairsStatTrait5;
    use TwoPairsStatTrait6;
    use TwoPairsStatTrait7;
    use TwoPairsTrait;


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        $rank = intval(substr($card, 0, -1));

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        if (count($hand) > count($ranksHand)) {
            return $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        }
        if (count($hand) === count($ranksHand)) {
            return $this->subCheck2($hand, $rank, $ranksHand, $ranksDeck) || $this->subCheck3($rank, $ranksHand, $ranksDeck);
        }
        return false;
    }
}
