<?php

namespace App\Project;

/**
 * Class representing a deck of cards, from kmom10/Project
 */
class Deck
{
    /**
     * @var array<string>
     */
    private array $cards = [];


    /**
     * Constructor
     */
    public function __construct(CardFactory $cardFactory = new CardFactory())
    {
        $this->cards = $cardFactory->fullSet();
    }

    /**
     * Deals the top-card from the deck (last card in the card array)
     */
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
     * Places a card on the top of the deck (end of the card array)
     */
    public function addCard(string $card): void
    {
        array_push($this->cards, $card);
    }

    /**
     * Returns an array with all cards
     * @return array<string>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Returns an array of the cards that will be dealt to house/player
     * i.e. array consisting of every other card except for the first two
     * that will not be dealt to either.
     * @return array<string>
     */
    public function possibleCards(int $mod = 1): array
    {
        $cards = [];
        $deck = $this->cards;
        $count = count($deck);

        // the first two cards in deck will not be picked by bank or by player
        for ($index = 2; $index < $count; $index++) {
            if ($index % 2 === $mod) {
                array_push($cards, $deck[$index]);
            }
        }
        (usort($cards, fn ($card1, $card2) => (intval(substr($card1, 0, -1)) - intval(substr($card2, 0, -1)))));
        return $cards;
    }
}
