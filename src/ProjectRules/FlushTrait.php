<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushTrait
{
    use FlushTrait3;
    use SameSuitTrait;


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
