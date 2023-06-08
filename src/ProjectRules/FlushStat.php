<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class FlushStat extends Rule implements RuleStatInterface
{
    use SameSuitTrait;

    /**
     * @param array<Card> $deck
     * @param array<Card> $newHand
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

        if (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - count($newHand))) {
            return true;
        }
        return false;
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

        $uniqueCountHand = $this->cardCounter->count($newHand);
        // /**
        //  * @var array<string,int> $suitsHand
        //  */
        // $suitsHand = $uniqueCountHand['suits'];

        // if (count($suitsHand) > 1) {
        //     return false;
        // }

        /**
         * @var array<string,array<int,int>> $uniqueCountHand
         */
        if ($this->setSuit($uniqueCountHand) === true) {
            return $this->checkInDeck($deck, $newHand);
        }

        // $uniqueCountDeck = $this->cardCounter->count($deck);
        // /**
        //  * @var array<string,int> $suitsDeck
        //  */
        // $suitsDeck = $uniqueCountDeck['suits'];

        // /**
        //  * @var string $suit
        //  */
        // $suit = array_key_first($suitsHand);

        // if (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - count($newHand))) {
        //     return true;
        // }

        return false;
    }
}
