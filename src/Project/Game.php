<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectRules\MoveEvaluator;


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
    private MoveEvaluator $moveEvaluator;

    /**
     * @param array<Grid> $grids
     */
    public function __construct(
        array $grids,
        Deck $deck = new Deck(),
        MoveEvaluator $moveEvaluator=new MoveEvaluator(),
    ) {
        $this->house = $grids['house'];
        $this->player = $grids['player'];
        $this->moveEvaluator = $moveEvaluator;
        $this->deck = $deck;
        $this->card = $this->deck->deal();
        $this->playerSuggest();
    }
}
