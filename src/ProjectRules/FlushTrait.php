<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushTrait
{
    use FlushTrait3;
    // use SameSuitTrait;


    /**
     * From StraightFlushTrait
     * Returns true if the rule is possible
     * to score without the dealt card
     * @param array<string> $hand
     * @param array<string> $deck
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
