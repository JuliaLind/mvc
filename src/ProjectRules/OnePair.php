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

    // /**
    //  * @var int $points the points if rule is  scored
    //  */
    // private int $points = 2;

    // /**
    //  * @var string $name name of the rule
    //  */
    // private string $name = "OnePair";

    // /**
    //  * @var int $minCountRank minimum count of a rank to score the rule
    //  */
    // private int $minCountRank = 2;

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
