<?php

namespace App\Project;

/**
 * Class representing a playing Card
 */
class Card
{
    /**
     * @var int $value The integer value of the card, 2-14
     * @var string $suit Suit of the card S|D|H|C
     */
    protected int $value;
    protected string $suit;

    /**
     * Constructor
     *
     * @param int $value - Value of the card
     * @param string $suit - Suit of the card
     */
    public function __construct(int $value, string $suit)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getRank(): int
    {
        return $this->value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * @return array<string>
     */
    public function graphic(): array
    {
        $name = "{$this->value}".$this->suit;
        $img = "img/project-cards/".$name.".svg";
        return [
            'img' => $img,
            'alt' => $name
        ];
    }
}
