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
     * Deals a card to the player
     *
     * @return void
     */
    public function deal();

    /**
     * Called after a card has been dealed to the player,
     * cards, calculates if the round is over and if over -
     * who the winner is
     *
     * @return bool
     */
    public function evaluate();

    /**
     * Deals cards to the bank
     * @return void
     */
    public function dealBank();


    /**
     * Called after tha bank is finished drawing cards,
     * calculates the winner
     *
     * @return void
     */
    public function evaluateBank();

    /**
     * Generates a flash message
     *
     * @return array<string>
     */
    public function generateFlash();

    /**
     * Returns status-data for current game
     *
     * @return array<mixed>
     */
    public function getGameStatus();

    /**
     * Returns data for each player
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getPlayerData();

    /**
     * Ends current round
     *
     * @return void
     */
    public function endRound();
}
