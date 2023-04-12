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
        'jokerB' => 15,
        'jokerR' => 16,
    ];


    public function __construct(String $suit, String $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
        $this->intValue = self::RANKVALUES[$rank];
        $color = "";
        switch($suit) {
            case 'S':
                $color = 'black';
                break;
            case 'C':
                $color = 'black';
                break;
            case 'H':
                $color = 'red';
                break;
            case 'D':
                $color = 'red';
                break;
            case '':
                switch(substr($this->rank, -1)) {
                    case 'B':
                        $color = 'black';
                        break;
                    case 'R':
                        $color = 'red';
                        break;
                }
                break;
        }
        $this->color = $color;
    }

    public function getIntValue(): int
    {
        return $this->intValue;
    }

    public function getSuit(): string
    {
        if ($this->suit === '') {
            return 'z';
        }
        return $this->suit;
    }


    public function getColor(): string
    {
        return $this->color;
    }

    public function rankExt(): string
    {
        $rank = $this->rank;
        switch ($rank) {
            case 'J':
                $rank = 'Jack';
                break;
            case 'Q':
                $rank = 'Queen';
                break;
            case 'K':
                $rank = 'King';
                break;
            case 'A':
                $rank = 'Ace';
                break;
            case 'jokerB':
                $rank = 'Joker Black';
                break;
            case 'jokerR':
                $rank = 'Joker Red';
                break;
        };
        return $rank;
    }

    public function suitExt(): string
    {
        $suit = $this->suit;
        switch ($suit) {
            case 'S':
                $suit = ' Spades';
                break;
            case 'D':
                $suit = ' Diamonds';
                break;
            case 'H':
                $suit = ' Hearts';
                break;
            case 'C':
                $suit = ' Clubs';
                break;
        };
        return $suit;
    }

    public function getAsString(): string
    {
        // $rank = $this->rank;
        // $suit = $this->suit;
        // switch ($rank) {
        //     case 'J':
        //         $rank = 'Jack';
        //         break;
        //     case 'Q':
        //         $rank = 'Queen';
        //         break;
        //     case 'K':
        //         $rank = 'King';
        //         break;
        //     case 'A':
        //         $rank = 'Ace';
        //         break;
        //     case 'jokerB':
        //         $rank = 'Joker Black';
        //         break;
        //     case 'jokerR':
        //         $rank = 'Joker Red';
        //         break;
        // };

        // switch ($suit) {
        //     case 'S':
        //         $suit = ' Spades';
        //         break;
        //     case 'D':
        //         $suit = ' Diamonds';
        //         break;
        //     case 'H':
        //         $suit = ' Hearts';
        //         break;
        //     case 'C':
        //         $suit = ' Clubs';
        //         break;
        // };

        // return $rank . $suit;
        return $this->rankExt() . $this->suitExt();
    }
}
