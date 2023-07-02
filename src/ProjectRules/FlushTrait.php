<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushTrait
{
    /**
     * @param array<string> $deck
     * @param array<string> $newHand
     */
    abstract private function checkInDeck(array $deck, array $newHand): bool;

    /**
     * From SameSuitTrait.
     * Sets suit attribute to the suit of the
     * first card in the hand and
     * returns true if all cards in the hand are
     * of the same suit
     * @param array<string> $hand
     */
    abstract private function setSuit(array $hand): bool;


    /**
     * From StraightFlushTrait
     * Returns true if the rule is possible
     * to score without the dealt card
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        return $this->setSuit($hand) && $this->checkInDeck($deck, $hand);
    }

}
