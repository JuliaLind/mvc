<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Class representing the hard version of the 21 card game
 */
class Game21Hard extends Game21Easy
{
    /**
     * Constructor
     *
     * @param Player21 $player
     * @param DeckOfCards $deck
     */
    public function __construct(Player21 $player=new Player21(), DeckOfCards $deck=new DeckOfCards())
    {
        parent::__construct($player, $deck);

        $this->level = 'hard';
    }
    // /**
    //  * Returns status data for current game
    //  *
    //  * @return array<mixed>
    //  */
    // public function getGameStatus(): array
    // {
    //     $data = parent::getGameStatus();
    //     $data['level'] = 'hard';
    //     return $data;
    // }

    /**
     * Deals cards to the bank. Stops when risk of bank getting "fat" is
     * at or above 50% or hand value is 21 or above or there are
     * no cards left
     * @return void
     */
    public function dealBank(): void
    {
        $this->bankPlaying = true;
        $bank = $this->bank;
        while (($bank->estimateRisk($this->deck) < 0.5) && ($this->cardsLeft() > 0) && $bank->handValue() < 21) {
            $bank->draw($this->deck);
        }
    }
}
