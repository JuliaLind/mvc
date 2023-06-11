<?php

namespace App\ProjectCard;

use App\ProjectExceptions\NoCardsException;

/**
 * Class representing a deck of cards
 */
class Deck
{
    /**
     * @var array<Card>
     */
    private array $cards = [];

    public function __construct(CardFactory $cardFactory = new CardFactory())
    {
        $this->cards = $cardFactory->fullSet();
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function deal(): Card
    {
        $card = array_pop($this->cards);
        if ($card === null) {
            throw new NoCardsException();
        }
        return $card;
    }

    /**
     * @return array<Card>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array<string>
     */
    public function getAsStringArr(): array
    {
        $cards = [];
        forEach($this->cards as $card) {
            array_push($cards, $card->name());
        }
        return $cards;
    }

    // public function peek(): Card
    // {
    //     $cards = $this->cards;
    //     return $cards[count($cards)-1];
    // }

    /**
     * @return array<Card>
     */
    public function possibleCards(): array
    {
        $cards = [];
        $deck = $this->cards;
        $count = count($deck);

        // the first two cards in deck will not be picked by bank or by playerS
        for ($i = 2; $i < $count; $i++) {
            if ($i % 2 === 1) {
                array_push($cards, $deck[$i]);
            }
        }
        return $cards;
    }
}
