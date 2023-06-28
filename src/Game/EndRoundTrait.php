<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

trait EndRoundTrait
{
    protected DeckOfCards $deck;
    protected MoneyPot $moneyPot;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $finished=false;
    protected bool $roundOver=false;

    abstract protected function getInvestLimit(): int;

    protected function determineWinner(): Player21
    {
        $player = $this->player;
        $bank = $this->bank;
        $winner = $bank;


        if ($player->getMoney() > $bank->getMoney()) {
            $winner = $player;
        }

        return $winner;
    }

    protected function finishGame(): void
    {
        if (($this->getInvestLimit() === 0 && $this->moneyPot->currentAmount() === 0)) {
            $this->finished = true;
        }
    }

    /**
     * Moves money from the money pot to the winner.
     * Determines if the game is finished,
     * and if it is - who the final winner is
     */
    protected function endRound(): void
    {
        $winner = $this->winner;
        $this->roundOver = true;

        $this->moneyPot->moneyToWinner($winner);

        if ($this->deck->getCardCount() === 0) {
            $this->finishGame();
            $winner = $this->determineWinner();
        }

        $this->winner = $winner;
    }

    /**
     * Returns indicator if game is over or not
     * @return bool true if the game is finished
     */
    public function gameOver(): bool
    {
        return $this->finished;
    }
}
