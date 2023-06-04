<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class FourOfAKind extends Rule implements RuleInterface
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
        $this->points = 50;
        $this->name = "Four Of A Kind";
        $this->minCountRank = 4;
    }
}
