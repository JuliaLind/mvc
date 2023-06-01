<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing CardFactory
 */
class CardFactory
{
    /**
     * Creturns an array with 52 playing cards
     *
     * @return array<Card>
     */
    public function fullSet(): array
    {
        $suits = ['S', 'D', 'H', 'C'];
        $minValue = 2;
        $maxValue = 14;
        $cards = [];
        foreach($suits as $suit) {
            for ($value = $minValue; $value <= $maxValue; $value++) {
                $card = new Card($value, $suit);
                array_push($cards, $card);
            }
        }
        return $cards;
    }

}
