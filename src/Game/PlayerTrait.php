<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Trate for base methods for a 21 player
 */
trait PlayerTrait
{
    /**
     * @var string $name
     * @var CardHand $hand
     */
    protected string $name='';
    protected CardHand $hand;

    /**
     * Getter of player's name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Draws 1 card from deck and adds to the player's hand
     *
     * @param DeckOfCards $deck the card-deck to draw card from
     * @return void
     */
    public function draw(DeckOfCards $deck): void
    {
        $this->hand->add($deck, 1);
    }

    /**
     * Returns array with cards' integer values
     *
     * @return array<int>
     */
    public function getCardValues(): array
    {
        return $this->hand->getValues();
    }

    /**
     * Returns array with associative arrays containing two strings - relative
     * svg-image path and description for each card
     * (to use for the alt text).
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

    /**
     * Returns the count of cards in player's hand.
     *
     * @return int
     */
    public function getCardCount(): int
    {
        return $this->hand->getCardCount();
    }

    /**
     * Removes all cards from player's hand
     *
     * @return void
     */
    public function emptyHand(): void
    {
        $this->hand->emptyHand();
    }
}
