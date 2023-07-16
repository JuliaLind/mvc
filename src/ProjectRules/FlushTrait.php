<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if a flush is possible to score in a partially filled hand,
 * without the dealt card.
 * From kmom10/Project
 */
trait FlushTrait
{
    use FlushTrait3;

    /**
     * From StraightFlushTrait
     * Returns true if the rule is possible
     * to score without the dealt card
     * @param array<string> $hand
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($hand);
        /**
         * @var string $suit
         */
        $suit = array_key_first($suits);

        return (count($suits) === 1)  && $this->checkInDeck($suit, $deck, count($hand));
    }

}
