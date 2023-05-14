<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait has setter and getter methods
 * to facilitate testing of the Game21Easy
 * and Game21Hard classes
 */
trait GameAttrHandlerTrait
{
    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected bool $finished=false;

    protected MoneyPot $moneyPot;

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
     * @return MoneyPot
     */
    public function getMoneyPot(): MoneyPot
    {
        return $this->moneyPot;
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
}
