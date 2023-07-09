<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class ApiGame1
{
    use ApiGame1OneRoundTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reset();
    }
}
