<?php

namespace App\Game;

interface Game21Interface
{
    /**
     * Returns indicator if game is over or not
     * @return bool
     */
    public function gameOver();

    /**
     * Increases number of currenRound attribute by 1.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @return array<int>
     */
    public function nextRound();

    /**
     * Moves the $amount of money from player and bank
     * to the moneypot
     * @param int $amount
     * @return void
     */
    public function addToMoneyPot(int $amount);

    /**
     * Deals a card to the player and returns data for setting flashmessage
     *
     * @return array<string>
     */
    public function deal();


    /**
     * Deals cards to the bank and returns data for setting flashmessage
     * @return array<string>
     */
    public function dealBank();

    /**
     * Returns all data for current game
     *
     * @return array<mixed>
     */
    public function getGameStatus();
}
