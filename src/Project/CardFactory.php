<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing CardFactory
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
        // return [
        //     "8D","11C","4S","8H","10C","9D","9C","8S","2D","6C",
        //     "9S","9H","14D","8C","5S","3C","7S","13S","11H","6H",
        //     "4D","2H","2S","13H","11S","14S","6D","5H","10S","7C",
        //     "10H","7H","4C","3H","14H","12D","13C","6S","3S","14C",
        //     "4H","12C","5C","12S","10D","12H","5D","11D","3D","7D",
        //     "13D", "2C"
        // ];
    }
}
