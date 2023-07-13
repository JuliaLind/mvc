<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Trait for handling bank's turn to pick cards int he 21 game, for the easy version of the game
 */
trait DealBankEasyTrait
{
    protected Player21 $bank;
    protected bool $bankPlaying=false;
    protected DeckOfCards $deck;


    /**
     * Deals cards to the bank until the value of bank's hand is at
     * or above 17 or there are no cards left in deck
     */
    protected function dealBank(): void
    {
        $this->bankPlaying = true;
        $bank = $this->bank;

        while (($bank->handValue() < 17) && ($this->deck->getCardCount() > 0)) {
            $bank->draw($this->deck);
        }
    }

}
