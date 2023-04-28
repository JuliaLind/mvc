<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing a deck of cards with jokers
 */
class DeckOfCardsExt extends DeckOfCards
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->cards[]=new CardGraphic('B', 'joker');
        $this->cards[]=new CardGraphic('R', 'joker');
    }
}
