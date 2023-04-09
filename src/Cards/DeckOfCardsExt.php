<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class DeckOfCardsExt extends DeckOfCards
{
    private $deck = [];

    public function __construct()
    {
        parent::__construct();
        // $this->add(new CardGraphic('', 15));
        // $this->add(new CardGraphic('', 16));
        $this->add(new CardGraphic('', 'jokerB'));
        $this->add(new CardGraphic('', 'jokerR'));
    }
}
