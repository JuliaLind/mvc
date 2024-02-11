<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Trait used in ApiGame1 class for generating a new grid and a new deck of cards,
 * from kmom10/Project
 */
trait ApiGame1ResetTrait
{
    private Grid $grid;
    private Deck $deck;

    /**
     * Resets the game with new full deck and new empty grid
     */
    public function reset(Grid $grid = new Grid(), Deck $deck = new Deck()): void
    {
        $this->grid = $grid;
        $this->deck = $deck;
    }
}
