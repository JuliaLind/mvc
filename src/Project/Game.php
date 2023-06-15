<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectRules\WinEvaluator;
use App\ProjectRules\MoveEvaluator;

use Symfony\Component\HttpFoundation\Request;

class Game
{
    private Grid $house;
    private Grid $player;
    private Deck $deck;
    private string $card;
    private bool $finished = false;

    public function __construct()
    {
        $this->house = new Grid();
        $this->player = new Grid();
        $deck = new Deck();
        $deck->shuffle();
        $this->deck = $deck;
    }

    public function deal(): void
    {
        $this->card = $this->deck->deal();
    }

    /**
     * @return array<string,string|array<int>>
     */
    public function playerSuggest(MoveEvaluator $evaluator=new MoveEvaluator()): array
    {
        return $evaluator->suggestion($this->player->rowsAndCols(), $this->card, $this->deck->possibleCards());
    }

    public function playerPlaceCard(Request $request): void
    {
        /**
         * @var int $row
         */
        $row = $request->get('row');
        /**
         * @var int $col
         */
        $col = $request->get('col');
        $this->player->addCard($row, $col, $this->card);
    }

    public function housePlaceCard(MoveEvaluator $evaluator=new MoveEvaluator()): void
    {
        $card = $this->deck->deal();
        $suggestion = $evaluator->suggestion($this->house->rowsAndCols(), $card, $this->deck->possibleCards());
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion['slot'];
        $this->house->addCard($slot[0], $slot[1], $card);
    }

    public function checkIfFinished(): bool
    {
        $finished = $this->house->getCardCount() === 25;
        $this->finished = $finished;
        return $finished;
    }

    /**
     * @return array<string,array<string,array<array<string,int|string>>|int>|string>
     */
    public function evaluate(WinEvaluator $evaluator=new WinEvaluator()): array
    {
        $playerData = $evaluator->results($this->player->rowsAndCols());
        $houseData = $evaluator->results($this->house->rowsAndCols());
        $winner = "player";
        if ($playerData['total'] <= $houseData['total']) {
            $winner = "house";
        }
        return [
            'winner' => $winner,
            'player' => $playerData,
            'house' => $houseData
        ];
    }

    /**
     * @return array<mixed>
     */
    public function currentState(GridGraphic $grid = new GridGraphic()): array
    {
        return [
            'house' => $grid->graphic($this->house->getCards()),
            'player' => $grid->graphic($this->player->getCards()),
            'card' => $this->card
        ];
    }

}
