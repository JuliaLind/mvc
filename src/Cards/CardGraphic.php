<?php

namespace App\Cards;

class CardGraphic extends Card
{
    public function __construct(String $suit, Int $intValue)
    {
        parent::__construct($suit, $intValue);
    }

    public function getAsString(): string
    {
        return ($this->rank . $this->suit . ".svg");
    }
}
