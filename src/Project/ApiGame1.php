<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Class that represents part of the logic of the Poker Squares game.
 * Represents the action of a bot picking up the top card fro ma deck and
 * placing it into a grid according to the calcualted suggestion. The data is then returned
 * for API route.  When the grid is
 * completely filled it is replaced by a new grid and the process starts all over again with one card palced each time the api orute is entered.
 */
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
