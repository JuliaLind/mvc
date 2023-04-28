<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

class DeckOfCardsExt extends DeckOfCards
{
    public function __construct()
    {
        parent::__construct();
        $this->deck[]=new CardGraphic('B', 'joker');
        $this->deck[]=new CardGraphic('R', 'joker');
    }
}
