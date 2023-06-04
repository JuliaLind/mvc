<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class FourOfAKind implements RuleInterface
{
    use RuleTrait;
    use SameRankTrait;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
        $this->points = 50;
        $this->name = "Four Of A Kind";
        $this->minCountRank = 4;
    }
}
