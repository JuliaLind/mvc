<?php

namespace App\Game;

trait DealBankTrait
{
    protected Player21 $bank;

    /**
     * Deals cards to the bank and returns data for setting flashmessage
     *
     * @return array<string> array where first string is flash message type and second is the message
     */
    public function dealBank(): array
    {
        $this->bankPlaying = true;
        $bank = $this->bank;
        $risk = 0;
        while (($risk <= 0.5) && ($this->cardsLeft() > 0) && $bank->handValue() < 21) {
            $bank->draw($this->deck);
            $risk = $this->estimateRisk();
        }
        $this->evaluateBank();
        return $this->generateFlash();
    }
}
