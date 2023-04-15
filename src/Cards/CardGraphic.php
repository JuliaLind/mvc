<?php

namespace App\Cards;

class CardGraphic extends Card
{
    public function getImgLink(): string
    {
        return ("img/cards/" . $this->rank . $this->suit . ".svg");
    }
}
