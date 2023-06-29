<?php

namespace App\ProjectCard;

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
    }
}
