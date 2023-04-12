<?php

namespace App\Cards;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;

class CardHand
{
    /**
     * @var array<CardGraphic|null> $hand The hand holding the cards.
     */
    private $hand = [];

    /**
     * @var string $playerName Name of the player the hand belongs to.
     */
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

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
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
     * Returns array with arrays comtaining
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

    public function getPlayerName(): string
    {
        return $this->playerName;
    }
}
