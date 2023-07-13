<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing a money pot in the 21 game
 */
class MoneyPot
{
    protected int $money=0;

    /**
     * Moves the $amount of money from player and bank
     * to the moneypot
     * @param int $amount
     * @param array<Player21> $players
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
     * @param Player21 $winner
     *
     * @return void
     */
    public function moneyToWinner(Player21 $winner): void
    {
        $winner->incrMoney($this->currentAmount());
        $this->money = 0;
    }

    /**
     * Getter for current amount of money in the pot
     *
     * @return int
     */
    public function currentAmount(): int
    {
        return $this->money;
    }
}
