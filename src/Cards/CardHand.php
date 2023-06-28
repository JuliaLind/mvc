<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";


/**
 * Class representing a hand that can hold cards
 */
class CardHand
{
    use CardDataTrait;


    /**
     * Draws a number of cards from the deck and adds to the
     * hand
     *
     * @param int $number - the number of cards to draw from the deck
     * @param DeckOfCards $deck - the deck to draw cards from
     * @return void
     */
    public function add(DeckOfCards $deck, int $number): void
    {
        for ($i = 1; $i <= $number; $i++) {
            try {
                $this->cards[] = $deck->draw();
            } catch (NoCardsLeftException) {
                break;
            }
        }
    }

    /**
     * Empties the hand
     *
     * @return void
     */
    public function emptyHand(): void
    {
        $this->cards = [];
    }

    /**
     * Returns array with arrays containing
     * relative paths to cards' images and description for each card.
     *
     * @return array<array<string>>
     */
    public function getImgLinksAndDescr(): array
    {
        $cards = [];
        foreach ($this->cards as $card) {
            $cards[] = [
                'link' => $card->getImgLink(),
                'descr' => $card->getAsString(),
            ];
        }
        return $cards;
    }
}
