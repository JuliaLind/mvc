<?php

namespace App\Cards;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;

class CardHand
{
    /**
     * @var array<CardGraphic|null> $hand The hand holding the cards.
     */
    protected $hand = [];

    public function add(DeckOfCards $deck, int $number): void
    {
        if ($number > $deck->getCardCount()) {
            $number = $deck->getCardCount();
        }
        if ($number > 0) {
            for ($i = 1; $i <= $number; $i++) {
                $this->hand[] = $deck->draw();
            }
        }
    }

    public function emptyHand(): void
    {
        $this->hand = [];
    }

    /**
     * Returns array with paths to card images.
     *
     * @return array<string>
     */
    public function getImgLinks(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            if ($card) {
                $cards[] = $card->getImgLink();
            }
        }
        return $cards;
    }

    /**
     * Returns array with arrays containing
     * paths to card image and description for each card.
     *
     * @return array<array<string>>
     */
    public function getImgLinksAndDescr(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            if ($card) {
                $cards[] = [
                    'link' => $card->getImgLink(),
                    'descr' => $card->getAsString(),
                ];
            }
        }
        return $cards;
    }

    /**
     * Returns array with description of each card.
     *
     * @return array<string>
     */
    public function getAsString(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            if ($card) {
                $cards[] = $card->getAsString();
            }

        }
        return $cards;
    }

    /**
     * Returns array with each cards integer value.
     *
     * @return array<int>
     */
    public function getValues(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            if ($card) {
                $cards[] = $card->getIntValue();
            }

        }
        return $cards;
    }

    public function getCardCount(): int
    {
        return count($this->hand);
    }
}
