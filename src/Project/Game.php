<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;


use Symfony\Component\HttpFoundation\Request;

require __DIR__ . "/../../vendor/autoload.php";

class Game
{
    use SuggestMessageTrait;
    use PlayerSuggestTrait;
    use MoveACardTrait;
    use UndoLastRoundTrait;
    use OneRoundTrait;
    use EvaluateTrait;
    use CurrentStateTrait;
    use PotTrait;


    private Grid $house;
    private Grid $player;
    private Deck $deck;
    private string $card;
    private RuleEvaluator $evaluator;

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
