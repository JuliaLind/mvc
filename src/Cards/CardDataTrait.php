<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";


trait CardDataTrait
{
    /**
     * @var array<CardGraphic> $cards Array for holding cards.
     */
    protected $cards = [];

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
     * Returns the number of counts left in the deck
     * @return int
     */
    public function getCardCount(): int
    {
        return count($this->cards);
    }
}
