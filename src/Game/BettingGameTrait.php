<?php

namespace App\Game;

trait BettingGameTrait
{
    protected int $moneyPot=0;
    protected Player21 $player;
    protected Player21 $bank;

    /**
     * Returns the lower of money of what
     * the bank or the player has
     * @return int
     */
    public function getInvestLimit(): int
    {
        $limit = $this->player->money;
        $money = $this->bank->money;
        if ($money < $limit) {
            $limit = $money;
        }
        return $limit;
    }

    /**
     * Moves the $amount of money from player and bank
     * to the moneypot
     * @param int $amount
     * @return void
     */
    public function addToMoneyPot(int $amount): void
    {
        $limit = $this->getInvestLimit();
        if ($limit < $amount) {
            $amount = $limit;
        }
        $this->moneyPot += $this->bank->decrMoney($amount);
        $this->moneyPot += $this->player->decrMoney($amount);
    }

    /**
     * Moves money from game pot to winner
     * @param Player21 $winner
     *
     * @return void
     */
    public function moneyToWinner(Player21 $winner): void
    {
        $winner->incrMoney($this->moneyPot);
        $this->moneyPot = 0;
    }
}
