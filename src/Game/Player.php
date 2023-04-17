<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

class Player
{
    /**
     * @var string $name
     * @var int $money
     * @var CardHand $hand 
     */
    protected string $name;
    protected int $money;
    protected CardHand $hand;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
        $this->money = 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMoney(): int
    {
        return $this->money;
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
     * Adds money to player
     *
     * @param int $money the amount of money to add
     * @return void
     */
    public function incrMoney(int $money): void
    {
        $this->money += $money;
    }

    /**
     * Removes money from player
     *
     * @return int the amount of money that was removed
     */
    public function decrMoney(int $money): int
    {
        $this->money -= $money;
        return $money;
    }

    /**
     * Returns array with card values.
     *
     * @return array<int>
     */
    public function getCardValues(): array
    {
        return $this->hand->getValues();
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

    /**
     * Returns the number of cards in hand.
     *
     * @return int
     */
    public function getCardCount(): int
    {
        return $this->hand->getCardCount();
    }

    /**
     * Removes all cards from hand
     *
     * @return void
     */
    public function emptyHand(): void
    {
        $this->hand->emptyHand();
    }

}
