<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushStatTrait2
{
    /**
     * @param array<string> $deck
     * @param array<string> $newHand
     */
    abstract private function checkInDeck(array $deck, array $newHand): bool;


    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        return $this->setSuit($hand) && $this->checkInDeck($deck, $hand);
    }

}
