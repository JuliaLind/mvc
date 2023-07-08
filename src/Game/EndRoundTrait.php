<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Ends a round of Game21
 */
trait EndRoundTrait
{
    protected DeckOfCards $deck;
    protected MoneyPot $moneyPot;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $finished=false;
    protected bool $roundOver=false;

    /**
     * Returns the lower of money of what
     * the bank or the player has
     */
    abstract protected function getInvestLimit(): int;

    /**
     * Determins the winner of the round
     */
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

    /**
     * If either player or bank has run out of money finishes the game
     */
    protected function finishGame(): void
    {
        if (($this->getInvestLimit() === 0 && $this->moneyPot->currentAmount() === 0)) {
            $this->finished = true;
        }
    }

    /**
     * Finished the round.
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
