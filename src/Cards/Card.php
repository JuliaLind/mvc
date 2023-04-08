<?php

namespace App\Cards;

class Card
{
    protected $rank;
    protected $suit;
    protected $intValue;
    protected $color;
    protected $ranks = [
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        '11' => 'J',
        '12' => 'Q',
        '13' => 'K',
        '14' => 'A',
        '15' => 'jokerB',
        '16' => 'jokerR',
    ];

    public function __construct(String $suit, Int $intValue)
    {
        $this->suit = $suit;
        $this->intValue = $intValue;
        $this->rank = $this->ranks[strval($intValue)];
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

    public function getAsString(): string
    {
        $rank = $this->rank;
        $suit = $this->suit;
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

        return $rank . $suit;
    }
}
