<?php

namespace App\Cards;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

class Player
{
    /**
     * @var string $name
     * @var CardHand $hand
     */
    protected string $name;
    protected CardHand $hand;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Draw 1 card from deck and add to hand
     *
     * @param DeckOfCards $deck the card-deck to draw cards from
     * @return void
     */
    public function draw(DeckOfCards $deck): void
    {
        $this->hand->add($deck, 1);
    }

    /**
     * Draw numner of cards from deck and add to hand
     *
     * @param DeckOfCards $deck the card-deck to draw cards from
     * @param int $number numner of cards to draw
     * @return void
     */
    public function drawMany(DeckOfCards $deck, int $number): void
    {
        $this->hand->add($deck, $number);
    }

    /**
     * Returns array with arrays containing
     * paths to card image and description for each card.
     *
     * @return array<array<string>>
     */
    public function showHandGraphic(): array
    {
        return $this->hand->getImgLinksAndDescr();
    }

    /**
     * Returns array with description of each card.
     *
     * @return array<string>
     */
    public function showHandAsString(): array
    {
        return $this->hand->getAsString();
    }
}
