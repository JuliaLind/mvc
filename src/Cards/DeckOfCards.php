<?php

namespace App\Cards;

use App\Cards\CardGraphic;

class DeckOfCards
{
    private $deck = [];

    public function __construct()
    {

        foreach (['D', 'H', 'C', 'S'] as $suit) {
            // for ($i = 2; $i <= 14; $i++) {
            //     $this->deck[] = new CardGraphic($suit, $i);
            // }
            for ($i = 2; $i <= 10; $i++) {
                $this->deck[] = new CardGraphic($suit, $i);
            }
            foreach (['J', 'Q', 'K', 'A'] as $rank) {
                $this->deck[] = new CardGraphic($suit, $rank);
            }
        }
    }

    public function add(CardGraphic $card): void
    {
        $this->deck[] = $card;
    }

    public function draw(): CardGraphic
    {
        $pickedCard = array_pop($this->deck);
        return $pickedCard;
    }

    public function getCardCount(): int
    {
        return count($this->deck);
    }

    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->deck as $card) {
            $cards[] = $card->getImgLink();
        }
        return $cards;
    }

    public function getAsString(): array
    {
        $cards = [];
        foreach ($this->deck as $card) {
            $cards[] = $card->getAsString();
        }
        return $cards;
    }

    public function sortByColor(): void
    {
        (usort($this->deck, fn ($a, $b) => strcmp($a->getColor(), $b->getColor())));
    }

    public function sortByValue(): void
    {
        (usort($this->deck, fn ($a, $b) => $a->getSuit() > $b->getSuit()));
    }

    public function sortBySuit(): void
    {
        (usort($this->deck, fn ($a, $b) => strcmp($a->getSuit(), $b->getSuit())));
    }

    // public function sort(): void
    // {
    //     $this->sortBySuit();
    //     $this->sortByValue();
    // }

    public function shuffle(): void
    {
        shuffle($this->deck);
    }

}
