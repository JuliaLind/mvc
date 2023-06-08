<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class Rule
{
    protected CardCounter $cardCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }
}
