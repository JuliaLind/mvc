<?php

namespace App\ProjectCard;

/**
 * Class representing a playing Card
 */
class Card
{
    /**
     * @var int $rank Rank of the card as integer 2-14
     * @var string $suit Suit of the card S|D|H|C
     */
    protected int $rank;
    protected string $suit;

    /**
     * Constructor
     *
     * @param int $rank - rank of the card
     * @param string $suit - Suit of the card
     */
    public function __construct(int $rank, string $suit)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    private function name(): string
    {
        return "{$this->rank}".$this->suit;
    }

    /**
     * @return array<string>
     */
    public function graphic(): array
    {
        $name = $this->name();
        $img = "img/project-cards/".$name.".svg";
        return [
            'img' => $img,
            'alt' => $name
        ];
    }
}
