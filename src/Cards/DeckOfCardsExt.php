<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class DeckOfCardsExt extends DeckOfCards
{
    public function __construct()
    {
        parent::__construct();
        $this->add(new CardGraphic('', 'jokerB'));
        $this->add(new CardGraphic('', 'jokerR'));
    }
}
