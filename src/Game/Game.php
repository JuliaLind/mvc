<?php

namespace App\Game;

use App\Cards\DeckOfCards;

class Game
{
    /**
     * @var DeckOfCards $deck Deck of cards.
     */
    protected $deck;

    /**
     * @var bool $finished Deck of cards.
     */
    public $finished;

    // /**
    //  * @param array<Player> $players
    //  */
    public function __construct(DeckOfCards $deck)
    {
        $this->deck = $deck;
        $this->deck->shuffle();
        $this->finished = false;
    }

    public function cardsLeft(): int
    {
        return $this->deck->getCardCount();
    }
}
