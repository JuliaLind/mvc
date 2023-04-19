<?php

namespace App\Game;

use App\Game\Player;

class MoneyPot
{
    protected int $money=0;

    /**
     * Moves the $amount of money from player and bank
     * to the moneypot
     * @param int $amount
     * @param array<Player> $players
     * @return void
     */
    public function addMoney(int $amount, array $players): void
    {
        foreach ($players as $player) {
            $this->money += $player->decrMoney($amount);
        }
    }

    /**
     * Moves money from game pot to winner
     * @param Player $winner
     *
     * @return void
     */
    public function moneyToWinner(Player $winner): void
    {
        $winner->incrMoney($this->money);
        $this->money = 0;
    }

    /**
     * Getter for current amount in moneypot
     *
     * @return int
     */
    public function currentAmount(): int
    {
        return $this->money;
    }
}
