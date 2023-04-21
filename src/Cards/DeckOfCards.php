<?php

namespace App\Cards;

use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

class DeckOfCards
{
    /**
     * @var array<CardGraphic> $deck The deck containing cards.
     */
    protected array $deck = [];

    public function __construct()
    {

        foreach (['D', 'H', 'C', 'S'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $this->deck[] = new CardGraphic($suit, strval($i));
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
        if ($pickedCard === null) {
            throw new NoCardsLeftException();
        }
        return $pickedCard;
    }

    public function getCardCount(): int
    {
        return count($this->deck);
    }

    /**
     * Returns array with paths to card images.
     *
     * @return array<string>
     */
    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->deck as $card) {
            $cards[] = $card->getImgLink();
        }
        return $cards;
    }

    /**
     * Returns array with description of each card.
     *
     * @return array<string>
     */
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
        usort($this->deck, fn ($card1, $card2) => strcmp($card1->getColor(), $card2->getColor()));
    }

    public function sortByValue(): void
    {
        usort($this->deck, fn ($card1, $card2) => ($card1->getIntValue() - $card2->getIntValue()));
    }

    public function sortBySuit(): void
    {
        (usort($this->deck, fn ($card1, $card2) => strcmp($card1->getSuit(), $card2->getSuit())));
    }

    // public function sort(): void
    // {
    //     $this->sortBySuit();
    //     $this->sortByValue();
    // }

    /**
     * Returns array with each cards integer value.
     *
     * @return array<int>
     */
    public function getValues(): array
    {
        $cards = [];
        foreach ($this->deck as $card) {
            $cards[] = $card->getIntValue();
        }
        return $cards;
    }

    public function shuffle(): void
    {
        shuffle($this->deck);
    }

}
