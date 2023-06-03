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
     * @return array<int>
     */
    public function ranksOfSuit(string $suit): array
    {
        $cards = $this->cards;
        $ranksOfSuit = [];
        foreach($cards as $card) {
            if ($card->getSuit() === $suit) {
                array_push($ranksOfSuit, $card->getRank());
            }
        }
        // if (count($ranksOfSuit) == 0) {
        //     throw new NoCardsException();
        // }
        return $ranksOfSuit;
    }

    /**
     * @return array<Card>
     */
    public function getCards(): array
    {
        $cards = $this->cards;
        return $cards;
    }
}
