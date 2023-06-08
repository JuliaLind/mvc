<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait to be used in betting games
 * between a player and a bank
 */
trait BettingGameTrait
{
    protected MoneyPot $moneyPot;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;

    /**
     * Returns the lower of money of what
     * the bank or the player has
     * @return int
     */
    public function getInvestLimit(): int
    {
        $limit = $this->player->getMoney();
        $money = $this->bank->getMoney();
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
        $this->moneyPot->addMoney($amount, [$this->player, $this->bank]);
    }

    /**
     * Check if there is a winner
     */
    public function isWinner(): bool
    {
        return $this->winner->getName() != '';
    }
}
