<?php

namespace App\Game;

use App\Cards\DeckOfCards;

class Game
{
    /**
     * @var DeckOfCards $deck Deck of cards.
     * @var bool $finished inidicator if the whole game is finished
     */
    protected DeckOfCards $deck;
    public bool $finished;

    /**
     * Constructor
     * @param DeckOfCards $deck
     */
    public function __construct(DeckOfCards $deck)
    {
        $this->deck = $deck;
        $this->deck->shuffle();
        $this->finished = false;
    }

    /**
     * Returns number of cards left in the deck
     * @return int the number of cards in deck
     */
    public function cardsLeft(): int
    {
        return $this->deck->getCardCount();
    }
}
