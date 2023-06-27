<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait TwoPairsStatTrait
{
    use TwoPairsStatTrait3;
    use TwoPairsStatTrait4;
    use TwoPairsStatTrait5;

    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;


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
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];


        if (count($hand) > count($ranksHand)) {
            return $this->subCheck4($hand, $ranksHand, $ranksDeck) || $this->subCheck5($ranksHand, $ranksDeck);
        }
        if (count($hand) === 1) {
            return array_key_exists(array_keys($ranksHand)[0], $ranksDeck) && max($ranksDeck) >= 2;
        }
        if (count($hand) <= 3) {
            return $this->subCheck6($ranksHand, $ranksDeck);
        }
        return false;
    }
}
