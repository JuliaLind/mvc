<?php

namespace App\Cards;

class CardGraphic extends Card
{
    // public function __construct(String $suit, Int $intValue)
    // {
    //     parent::__construct($suit, $intValue);
    // }
    // public function __construct(String $suit, String $rank)
    // {
    //     parent::__construct($suit, $rank);
    // }

    public function getImgLink(): string
    {
        return ("img/cards/" . $this->rank . $this->suit . ".svg");
    }
}
