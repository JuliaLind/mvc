<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class OnePair extends Rule implements RuleInterface
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
        $this->points = 2;
        $this->name = "One Pair";
        $this->minCountRank = 2;
    }
}
