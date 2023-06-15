<?php

namespace App\ProjectCard;

/**
 * Class representing a deck of cards
 */
class Deck
{
    /**
     * @var array<string>
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

    public function deal(): string
    {
        /**
         * @var string $card
         */
        $card = array_pop($this->cards);
        if ($card == null) {
            throw new NoCardsException();
        }
        return $card;
    }

    /**
     * @return array<string>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array<string>
     */
    public function possibleCards(): array
    {
        $cards = [];
        $deck = $this->cards;
        $count = count($deck);

        // the first two cards in deck will not be picked by bank or by player
        for ($index = 2; $index < $count; $index++) {
            if ($index % 2 === 1) {
                array_push($cards, $deck[$index]);
            }
        }
        return $cards;
    }
}
