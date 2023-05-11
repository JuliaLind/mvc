<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

// use App\cards\NoCardsLeftException;

/**
 * Class representing a deck of cards with no jokers
 */
class DeckOfCards
{
    /**
     * @var array<CardGraphic> $cards array containing Cards.
     */
    protected array $cards = [];

    /**
     * Constructor, creates a set of cards
     */
    public function __construct()
    {
        foreach (['D', 'H', 'C', 'S'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $this->cards[] = new CardGraphic($suit, strval($i));
            }
            foreach (['J', 'Q', 'K', 'A'] as $rank) {
                $this->cards[] = new CardGraphic($suit, $rank);
            }
        }
    }

    /**
     * Removes the last card from the cards-array
     * @return CardGraphic - the removed card
     */
    public function draw(): CardGraphic
    {
        $pickedCard = array_pop($this->cards);
        if ($pickedCard === null) {
            throw new NoCardsLeftException();
        }
        return $pickedCard;
    }

    /**
     * Returns the number of counts left in the deck
     * @return int
     */
    public function getCardCount(): int
    {
        return count($this->cards);
    }

    /**
     * Returns array with paths to card images.
     *
     * @return array<string>
     */
    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->cards as $card) {
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
        foreach ($this->cards as $card) {
            $cards[] = $card->getAsString();
        }
        return $cards;
    }

    /**
     * Returns array with each card's integer value.
     *
     * @return array<int>
     */
    public function getValues(): array
    {
        $cards = [];
        foreach ($this->cards as $card) {
            $cards[] = $card->getIntValue();
        }
        return $cards;
    }

    /**
     * Randomly shuffles the ramining cards in the deck
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    /**
     * Use for testing purposes, sests a custom
     * card array to the cards-attribute
     *
     * @param array<CardGraphic> $cards
     * @return void
     */
    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    // public function sortByColor(): void
    // {
    //     usort($this->card, fn ($card1, $card2) => strcmp($card1->getColor(), $card2->getColor()));
    // }

    // public function sortByValue(): void
    // {
    //     usort($this->card, fn ($card1, $card2) => ($card1->getIntValue() - $card2->getIntValue()));
    // }

    // public function sortBySuit(): void
    // {
    //     (usort($this->deck, fn ($card1, $card2) => strcmp($card1->getSuit(), $card2->getSuit())));
    // }
}
