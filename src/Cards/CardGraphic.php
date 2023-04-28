<?php

namespace App\Cards;

/**
 * Class representing a playing Card with
 * graphic representation (i.e. svg image)
 */
class CardGraphic extends Card
{
    /**
     * Creates and returns the relative path to
     * the card's svg image
     * @return string
     */
    public function getImgLink(): string
    {
        return ("img/cards/" . $this->rank . $this->suit . ".svg");
    }
}
