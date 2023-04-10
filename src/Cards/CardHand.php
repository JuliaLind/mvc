<?php

namespace App\Cards;

use App\Cards\DeckOfCards;
use App\Cards\Card;

class CardHand
{
    private $hand = [];
    protected $playerName;

    public function __construct(DeckOfCards $deck, int $number, string $playerName)
    {
        $this->playerName = $playerName;
        if ($number > $deck->getCardCount()) {
            $number = $deck->getCardCount();
        }
        if ($number > 0) {
            for ($i = 1; $i <= $number; $i++) {
                $this->hand[] = $deck->draw();
            }
        }
    }

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getImgLink();
        }
        return $cards;
    }

    public function getAsString(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getAsString();
        }
        return $cards;
    }

    public function getPlayerName(): string
    {
        return $this->playerName;
    }
}
