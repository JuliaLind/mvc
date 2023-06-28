<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

trait DealBankHardTrait
{
    protected Player21 $bank;
    protected bool $bankPlaying=false;
    protected DeckOfCards $deck;

    /**
     * Deals cards to the bank. Stops when risk of bank getting "fat" is
     * at or above 50% or hand value is 21 or above or there are
     * no cards left
     * @return void
     */
    protected function dealBank(): void
    {
        $this->bankPlaying = true;
        $bank = $this->bank;
        while (($bank->estimateRisk($this->deck) < 0.5) && ($this->deck->getCardCount() > 0) && $bank->handValue() < 21) {
            $bank->draw($this->deck);
        }
    }

}
