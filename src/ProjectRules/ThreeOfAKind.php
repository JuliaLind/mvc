<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class ThreeOfAKind extends Rule implements RuleInterface
{
    use RuleTrait;
    use SameRankTrait;

    // /**
    //  * @var int $points the points if rule is  scored
    //  */
    // private int $points = 10;

    // /**
    //  * @var string $name name of the rule
    //  */
    // private string $name = "Three Of A Kind";

    // /**
    //  * @var int $minCountRank minimum count of a rank to score the rule
    //  */
    // private int $minCountRank = 3;
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
