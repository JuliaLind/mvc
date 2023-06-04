<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class ThreeOfAKind implements RuleInterface
{
    use RuleTrait;
    use SameRankTrait;

    public function __construct(
        CardCounter $cardCounter = new CardCounter()
    ) {
        $this->cardCounter = $cardCounter;
        $this->points = 10;
        $this->name = "Three Of A Kind";
        $this->minCountRank = 3;
    }
}
