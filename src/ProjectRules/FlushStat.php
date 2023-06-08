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

        return (array_key_exists($suit, $suitsDeck) && $suitsDeck[$suit] >= (5 - count($newHand)));
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


        return $this->setSuit($uniqueCountHand) && $this->checkInDeck($deck, $newHand);
    }
}
