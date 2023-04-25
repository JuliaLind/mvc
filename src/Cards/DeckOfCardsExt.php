<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class DeckOfCardsExt extends DeckOfCards
{
    public function __construct()
    {
        parent::__construct();
        $this->deck[]=new CardGraphic('B', 'joker');
        $this->deck[]=new CardGraphic('R', 'joker');
    }
}
