<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightFlushStat extends RuleStat implements RuleStatInterface
{
    use RankLimitsTrait;
    use StraightFlushStatTrait;
    use StraightStatTrait;

    /**
     * @param array<string,array<int,int>> $uniqueCountHand
     */
    protected function setSuit(array $uniqueCountHand): bool
    {
        /**
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];

        if (count($suitsHand) > 1) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $this->suit = $suit;
        return true;
    }

    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, Card $card): bool
    {
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($newHand);


        if ($this->setSuit($uniqueCountHand) === false || $this->setRankLimits($uniqueCountHand) === false) {
            return false;
        }

        $allCards = array_merge($newHand, $deck);
        return $this->checkAllPossible($allCards);
    }
}
