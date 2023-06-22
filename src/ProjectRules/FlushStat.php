<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class FlushStat extends Rule implements RuleStatInterface
{
    use SameSuitTrait;


    /**
     * @param array<string> $deck
     * @param array<string> $newHand
     */
    protected function checkInDeck(array $deck, array $newHand): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<string,int> $suitsDeck
         */
        $suitsDeck = $uniqueCountDeck['suits'];

        /**
         * @var string $suit
         */
        $suit = $this->suit;

        return (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - count($newHand)));
    }

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
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
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check2(array $hand, array $deck): bool
    {
        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        $uniqueCountHand = $this->cardCounter->count($hand);


        return $this->setSuit($uniqueCountHand) && $this->checkInDeck($deck, $hand);
    }
}
