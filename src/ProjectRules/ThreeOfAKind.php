<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class ThreeOfAKind extends Rule implements RuleInterface
{
    use RuleTrait;
    use SameRankTrait;

    protected int $points;
    protected string $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->points = 10;
        $this->name = "Three Of A Kind";
        $this->minCountRank = 3;
    }
}
