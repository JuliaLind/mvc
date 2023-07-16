<?php

namespace App\Game;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard, from kmom03-04
 */
interface Game21Interface
{
    /**
     * Returns bool indicator if game is over or not
     * @return bool true if game is over
     */
    public function gameOver();

    /**
     * Moves the $amount of money from player and bank
     * to the moneypot
     * @param int $amount
     * @return void
     */
    public function addToMoneyPot(int $amount);

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


    /**
     * Returns the risk as string for the currently playing
     * party
     * @return string
     */
    public function getRisk();


    /**
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function banksTurn(): array;


    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function playersTurn(): array;


    /**
     * Increases number of currenRound attribute by 1
     * and resets for next round.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @return array<int>
     */
    public function nextRound(): array;
}
