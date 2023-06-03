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
}
