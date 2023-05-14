<?php

namespace App\Game;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface Game21Interface
{
    /**
     * Returns bool indicator if game is over or not
     * @return bool true if game is over
     */
    public function gameOver();

    // /**
    //  * Increases the number of curren round attribute by 1.
    //  * Returns an associative array with investment
    //  * limit, player's money and number of next round
    //  * @return array<int>
    //  */
    // public function nextRound();

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
     * Called after a card has been dealed to the player
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
     * Called after the bank is finished drawing cards
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
     * Returns current data for each player
     *
     * @return array<array<mixed>>
     */
    public function getPlayerData();

    // /**
    //  * Ends current round
    //  *
    //  * @return void
    //  */
    // public function endRound();

    /**
     * Returns the risk as string for the currently playing
     * party
     * @return string
     */
    public function getRisk();
}
