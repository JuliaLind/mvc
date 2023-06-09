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
        $cards = $this->cards;
        return $cards;
    }

    /**
     * @return array<Card>
     */
    public function possibleCards(): array
    {
        $cards = [];
        $deck = $this->cards;

        foreach ($deck as $index => $card) {
            if ($index % 2 === 1) {
                array_push($cards, $card);
            }
        }
        return $cards;
    }
}
