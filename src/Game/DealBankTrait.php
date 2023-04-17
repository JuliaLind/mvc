<?php

namespace App\Game;

trait DealBankTrait
{
    protected Player21 $bank;

    /**
     * Deals cards to the bank and returns indicator
     * of if the round is over or if the game is over
     *
     * @return int
     */
    public function dealBank(): int
    {
        $bank = $this->bank;
        $handValue = $bank->handValue();
        $evaluate = -1;
        $risk = 0;
        while (($risk <= 0.5) && ($this->cardsLeft() > 0) && $handValue < 21) {
            $bank->draw($this->deck);
            $risk = $this->estimateRisk();
            $handValue = $bank->handValue();
        }
        $evaluate = $this->evaluateBank();
        return $evaluate;
    }
}
