<?php

namespace App\Cards;

// use App\Cards\CardGraphic;
use App\Cards\Card;

class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getImgLink();
        }
        return $cards;
    }

    public function getAsString(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getAsString();
        }
        return $cards;
    }
}
