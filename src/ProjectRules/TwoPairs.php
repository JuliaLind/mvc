<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class TwoPairs implements RuleInterface
{
    use TwoPairsTrait;
    use TwoPairsTrait2;

    protected CardCounter $cardCounter;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
    }

}
