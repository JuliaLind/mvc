<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing CardFactory. Is passed as arguemnt into a Deck class
 * for generating a full set of cards, from kmom10/Project
 */
class CardFactory
{
    /**
     * Returns an shuffled array with 52 playing cards
     *
     * @return array<string>
     */
    public function fullSet(): array
    {
        $suits = ['S', 'D', 'H', 'C'];
        $minRank = 2;
        $maxRank = 14;
        $cards = [];
        foreach($suits as $suit) {
            for ($rank = $minRank; $rank <= $maxRank; $rank++) {
                $card = strval($rank).$suit;
                array_push($cards, $card);
            }
        }
        shuffle($cards);
        return $cards;
    }
}
