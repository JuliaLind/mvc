<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Evaluates the hands of player and house after
 * both grids have been filled and determins
 * winner. If player won transfers 2x pot to
 * player/user and registers players score to database.
 */
trait ApiGame1ResetTrait
{
    private Grid $grid;
    private Deck $deck;

    /**
     * Resets the game with new full deck and new empty grid
     */
    public function reset(Grid $grid=new Grid(), Deck $deck=new Deck()): void
    {
        $this->grid = $grid;
        $this->deck = $deck;
    }
}
