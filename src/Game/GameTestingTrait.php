<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait has setter and getter methods
 * to facilitate testing of the Game21Easy
 * and Game21Hard classes
 */
trait GameTestingTrait
{
    protected Player21 $bank;
    /**
     * @var Player21 $winner.
     */
    protected $winner=null;

    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected bool $finished=false;

    /**
     * Setter method for moneypot
     * @param MoneyPot $moneyPot
     * @return void
     */
    public function setMoneyPot($moneyPot): void
    {
        $this->moneyPot = $moneyPot;
    }

    /**
     * Setter method for bank
     * @param Player21 $bank
     * @return void
     */
    public function setBank($bank): void
    {
        $this->bank = $bank;
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
        if ($this->winner === null) {
            return new Player21('');
        }
        return $this->winner;
    }

    /**
     * Setter method for roundOver
     * @param bool $bool
     * @return void
     */
    public function setRoundOver($bool): void
    {
        $this->roundOver = $bool;
    }

    /**
     * Getter method for roundOver
     * @return bool
     */
    public function isRoundOver(): bool
    {
        return $this->roundOver;
    }

    /**
     * Getter method for bankPlaying
     * @return bool
     */
    public function isBankPlaying(): bool
    {
        return $this->bankPlaying;
    }

    /**
     * Setter method for bankPlaying
     * @param bool $bool
     */
    public function setBankPlaying(bool $bool): void
    {
        $this->bankPlaying = $bool;
    }

    /**
     * Setter method for finished
     * @param bool $bool
     * @return void
     */
    public function setFinished($bool): void
    {
        $this->finished = $bool;
    }

    // /**
    //  * Getter method for finished
    //  * @return bool
    //  */
    // public function isFinished(): bool
    // {
    //     return $this->finished;
    // }
}
