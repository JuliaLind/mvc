<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Class representing a deck of cards with no jokers
 */
class DeckOfCards
{
    use CardDataTrait;


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
}
