<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

use App\Exceptions\NoCardsLeftException;

class CardHand
{
    /**
     * @var array<CardGraphic|null> $hand The hand holding the cards.
     */
    protected $hand = [];

    public function add(DeckOfCards $deck, int $number): void
    {
        for ($i = 1; $i <= $number; $i++) {
            try {
                $this->hand[] = $deck->draw();
            } catch (NoCardsLeftException) {
                break;
            }
        }
    }

    public function emptyHand(): void
    {
        $this->hand = [];
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
