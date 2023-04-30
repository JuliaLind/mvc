<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Class representing a Player
 */
class Player
{
    /**
     * @var string $name
     * @var int $money
     * @var CardHand $hand
     */
    protected string $name;
    protected int $money=0;
    protected CardHand $hand;

    /**
     * Constructor
     * @param string $name - Name of the player
     * @param CardHand $hand
     */
    public function __construct(string $name, CardHand $hand=new CardHand())
    {
        $this->name = $name;
        $this->hand = $hand;
    }

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
     * Getter of the amount of money the player currently has
     *
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
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
     * Increases player's money
     *
     * @param int $money the amount of money to add
     * @return void
     */
    public function incrMoney(int $money): void
    {
        $this->money += $money;
    }

    /**
     * Decreases player's money and returns the corresponding amount
     *
     * @return int the amount of money that was substracted
     */
    public function decrMoney(int $money): int
    {
        $this->money -= $money;
        return $money;
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
