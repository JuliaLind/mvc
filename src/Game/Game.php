<?php

namespace App\Game;

use App\Cards\DeckOfCards;

/**
 * Base class for a card game
 */
class Game
{
    /**
     * @var DeckOfCards $deck Deck of cards.
     * @var bool $finished inidicator if the whole game is finished
     */
    protected DeckOfCards $deck;
    protected bool $finished=false;

    /**
     * Constructor
     * @param DeckOfCards $deck
     */
    public function __construct(DeckOfCards $deck=new DeckOfCards())
    {
        $this->deck = $deck;
        $this->deck->shuffle();
        // $this->finished = false;
    }

    /**
     * Returns number of cards left in the deck
     * @return int the number of cards in deck
     */
    public function cardsLeft(): int
    {
        return $this->deck->getCardCount();
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
