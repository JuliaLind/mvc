<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Class representing a hand that can hold cards
 */
class CardHand
{
    /**
     * @var array<CardGraphic|null> $cards Array for holding cards.
     */
    private $cards = [];

    /**
     * Draws a number of cards from the deck and adds to the
     * hand
     *
     * @param int $number - the number of cards to draw from the deck
     * @param DeckOfCards $deck - the deck to draw cards from
     * @return void
     */
    public function add(DeckOfCards $deck, int $number): void
    {
        for ($i = 1; $i <= $number; $i++) {
            try {
                $this->cards[] = $deck->draw();
            } catch (NoCardsLeftException) {
                break;
            }
        }
    }

    /**
     * Empties the hand
     *
     * @return void
     */
    public function emptyHand(): void
    {
        $this->cards = [];
    }

    /**
     * Returns array with arrays containing
     * relative paths to cards' images and description for each card.
     *
     * @return array<array<string>>
     */
    public function getImgLinksAndDescr(): array
    {
        $cards = [];
        foreach ($this->cards as $card) {
            if ($card) {
                $cards[] = [
                    'link' => $card->getImgLink(),
                    'descr' => $card->getAsString(),
                ];
            }
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
            if ($card) {
                $cards[] = $card->getAsString();
            }

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
            if ($card) {
                $cards[] = $card->getIntValue();
            }

        }
        return $cards;
    }

    /**
     * Returns the count of cards the hand is currently
     * holding
     *
     * @return int
     */
    public function getCardCount(): int
    {
        return count($this->cards);
    }
}
