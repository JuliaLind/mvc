<?php

namespace App\Cards;

/**
 * Class representing a playing Card
 */
class Card
{
    /**
     * @var int $intValue The integer value of the card, 2-14 for 2-A and each joker
     * is 15.
     * @var string $rank Rank of the card joker|A|K|Q|J|10...2.
     * @var string $suit Suit of the card S|D|H|C for ordinary cards,
     * B for Black Joker and R for Red Joker.
     * @var string $color Color of the card - black|red.
     */
    protected int $intValue;
    protected string $rank;
    protected string $suit;
    protected string $color;

    /**
     * @var array<str|int> $RANKVALUES associative array
     * for conversion of rank to integer value
     */
    protected const RANKVALUES = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
        'joker' => 15,
    ];


    /**
     * Constructor
     *
     * @param string $suit - Suit of the card (uppercase, first letter only)
     * @param string $rank - Rank of the card (joker|A|K|Q|J|10-2)
     */
    public function __construct(string $suit, string $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
        $this->intValue = self::RANKVALUES[$rank];
        $conversionArray = [
            'S'=>'black',
            'D'=>'red',
            'H'=>'red',
            'C'=>'black',
            'B'=>'black',
            'R'=>'red',
        ];
        $this->color = $conversionArray[$suit];
    }

    /**
     * Getter for integer value of the card
     * @return int
     */
    public function getIntValue(): int
    {
        return $this->intValue;
    }

    /**
     * Getter for suit of the card
     * @return string S|D|H|C|B|J
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * Getter for color of the card
     * @return string black|red
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Getter for rank of the card, full word
     * @return string
     */
    protected function rankExt(): string
    {
        $rank = $this->rank;
        $conversionArray = [
            'J'=>'Jack',
            'Q'=>'Queen',
            'K'=>'King',
            'A'=>'Ace',
            'joker'=>'Joker',
        ];
        if (array_key_exists($rank, $conversionArray)) {
            return $conversionArray[$rank];
        }
        return $rank;
    }

    /**
     * Getter for suit of the card, full word
     * @return string
     */
    protected function suitExt(): string
    {
        $suit = $this->suit;
        $conversionArray = [
            'S'=>' Spades',
            'D'=>' Diamonds',
            'H'=>' Hearts',
            'C'=>' Clubs',
            'B'=>' Black',
            'R'=>' Red',
        ];
        return $conversionArray[$suit];
    }

    /**
     * Returns rank and suit of the card
     * in full words, for example 'Jack Diamonds'
     * or 'Joker Red'
     * @return string
     */
    public function getAsString(): string
    {
        return $this->rankExt() . $this->suitExt();
    }
}
