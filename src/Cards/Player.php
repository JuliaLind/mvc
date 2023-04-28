<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Class representing a Player
 */
class Player
{
    /**
     * @var string $name
     * @var CardHand $hand
     */
    protected string $name;
    protected CardHand $hand;

    /**
     * Constructor
     * @param string $name - Name of the player
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
    }

    /**
     * Getter of player's name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Draw a card from the deck and add to the player's hand
     *
     * @param DeckOfCards $deck the card-deck to draw card from
     * @return void
     */
    public function draw(DeckOfCards $deck): void
    {
        $this->hand->add($deck, 1);
    }

    /**
     * Draw number of cards from deck and add to hand
     *
     * @param DeckOfCards $deck - the card-deck to draw cards from
     * @param int $number - number of cards to draw
     * @return void
     */
    public function drawMany(DeckOfCards $deck, int $number): void
    {
        $this->hand->add($deck, $number);
    }

    /**
     * Returns array with associative arrays containing two strings - relative
     * svg-image path and description for each card
     * (to use for the alt text)..
     *
     * @return array<array<string>>
     */
    public function showHandGraphic(): array
    {
        return $this->hand->getImgLinksAndDescr();
    }

    /**
     * Returns array with description of each card.
     *
     * @return array<string>
     */
    public function showHandAsString(): array
    {
        return $this->hand->getAsString();
    }
}
