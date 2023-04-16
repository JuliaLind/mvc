<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

class Player implements PlayerInterface
{
    /**
     * @var string $name Name of the player the hand belongs to.
     */
    protected $name;

    /**
     * @var int $money
     */
    protected $money;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var CardHand $hand hand holding cards
     */
    protected $hand;

    public function __construct(string $name, string $type="player")
    {
        $this->name = $name;
        $this->hand = new CardHand();
        $this->type = $type;
    }

    public function drawMany(DeckOfCards $deck, int $number): void
    {
        $this->hand->add($deck, $number);
    }

    public function draw(DeckOfCards $deck): void
    {
        $this->hand->add($deck, 1);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function incrMoney(int $money): void
    {
        $this->money += $money;
    }

    public function decrMoney(int $money): int
    {
        $this->money -= $money;
        return $money;
    }

    public function getMinPoints(): int
    {
        $values = $this->hand->getValues();
        return array_sum($values);
    }


    public function getPoints(): int
    {
        $values = $this->hand->getValues();
        return array_sum($values);
    }

    /**
     * Returns array with card values.
     *
     * @return array<int>
     */
    public function getCardValues(): array
    {
        return $this->hand->getValues();
    }

    /**
     * Returns array with arrays containing
     * paths to card image and description for each card.
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

    public function getCardCount(): int
    {
        return $this->hand->getCardCount();
    }

    public function emptyHand(): void
    {
        $this->hand->emptyHand();
    }

    public function getType(): string
    {
        return $this->type;
    }
}
