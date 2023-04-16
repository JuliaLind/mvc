<?php

namespace App\Game;

use App\Cards\DeckOfCards;

/**
 * A interface for player
 */
interface PlayerInterface
{
    /**
     * Draw a card from deck of cards
     *
     * @return void
     */
    public function draw(DeckOfCards $deck);

    /**
     * Get the name
     *
     * @return string
     */
    public function getName();


    /**
     * Get the money amount
     *
     * @return int 
     */
    public function getMoney();

    /**
     *
     * @return void 
     */
    public function incrMoney(int $money);

    /**
     * Decreases player's money and returns
     * the amount
     *
     * @return int 
     */
    public function decrMoney(int $money);

    /**
     *
     * @return int
     */
    public function getMinPoints();

    /**
     *
     * @return int
     */
    public function getPoints();

    /**
     * Returns array with card values.
     *
     * @return array<int>
     */
    public function getCardValues();

    /**
     * Returns array with arrays containing
     * paths to card image and description for each card.
     *
     * @return array<array<string>>
     */
    public function showHandGraphic();

    /**
     * Returns array with description of each card.
     *
     * @return array<string>
     */
    public function showHandAsString();

    /**
     *
     * @return int
     */
    public function getCardCount();

    /**
     *
     * @return void
     */
    public function emptyHand();

    /**
     *
     * @return string
     */
    public function getType();
}
