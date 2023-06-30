<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;

require __DIR__ . "/../../vendor/autoload.php";

class Game
{
    use CurrentStateTrait;
    use EvaluateTrait;
    use HousePlaceCardTrait;
    use MoveACardTrait;
    use OneRoundTrait;
    use PlayerSuggestTrait;
    use PotTrait;
    use SuggestMessageTrait;
    use UndoLastRoundTrait;

    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private Grid $house;
    private Grid $player;

    /**
     * @param array<Grid> $grids
     */
    public function __construct(
        array $grids,
        Deck $deck = new Deck(),
        RuleEvaluator $evaluator=new RuleEvaluator(),
    ) {
        $this->house = $grids['house'];
        $this->player = $grids['player'];
        $this->evaluator = $evaluator;
        $this->deck = $deck;
        $this->card = $this->deck->deal();
        $this->playerSuggest();
    }
}
