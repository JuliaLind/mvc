<?php

namespace App\Cards;

class Card
{
    protected string $rank;
    protected string $suit;
    protected int $intValue;
    protected string $color;

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


    public function __construct(String $suit, String $rank)
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

    public function getIntValue(): int
    {
        return $this->intValue;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }


    public function getColor(): string
    {
        return $this->color;
    }

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

    public function getAsString(): string
    {
        return $this->rankExt() . $this->suitExt();
    }
}
