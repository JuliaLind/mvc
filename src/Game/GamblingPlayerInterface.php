<?php

namespace App\Game;

/**
 * Interface to be implemented by the Player21 class
 */
interface GamblingPlayerInterface
{
    /**
     * Getter of the amount of money the player currently has
     *
     * @return int
     */
    public function getMoney(): int;


    /**
     * Increases player's money
     *
     * @param int $money the amount of money to add
     * @return void
     */
    public function incrMoney(int $money): void;

    /**
     * Decreases player's money and returns the corresponding amount
     *
     * @return int the amount of money that was substracted
     */
    public function decrMoney(int $money): int;
}
