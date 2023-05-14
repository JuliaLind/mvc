<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait has setter and getter methods
 * to facilitate testing of the Game21Easy
 * and Game21Hard classes
 */
trait GameAttrHandler2Trait
{
    protected Player21 $bank;
    protected Player21 $player;
    protected Player21 $winner;

    protected int $currentRound=0;

    /**
     * @param Player21 $player
     * @return void
     */
    public function setPlayer($player): void
    {
        $this->player = $player;
    }

    /**
     * @return Player21
     */
    public function getPlayer(): Player21
    {
        return $this->player;
    }

    /**
     * @param Player21 $bank
     * @return void
     */
    public function setBank($bank): void
    {
        $this->bank = $bank;
    }

    /**
     * @return Player21
     */
    public function getBank(): Player21
    {
        return $this->bank;
    }

    /**
     * Setter method for winner
     * @param Player21 $winner
     * @return void
     */
    public function setWinner($winner): void
    {
        $this->winner = $winner;
    }

    /**
     * Getter method for winner
     * @return Player21
     */
    public function getWinner(): Player21
    {
        return $this->winner;
    }

    /**
     * @param int $round
     * @return void
     */
    public function setCurrentRound(int $round): void
    {
        $this->currentRound = $round;
    }


    public function getCurrentRound(): int
    {
        return $this->currentRound;
    }
}
