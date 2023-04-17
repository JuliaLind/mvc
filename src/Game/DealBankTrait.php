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
        $evaluate = -1;
        $risk = 0;
        while (($risk <= 0.5) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
            $risk = $this->estimateRisk();
        }
        $evaluate = $this->evaluateBank();
        return $evaluate;
    }
}
