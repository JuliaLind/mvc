<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class CardHand
{
    private $hand = [];

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
    }

    public function getString(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getAsString();
        }
        return $cards;
    }

    public function getTextRepresentation(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getAsText();
        }
        return $cards;
    }
}
