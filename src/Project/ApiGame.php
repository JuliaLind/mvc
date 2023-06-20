<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectRules\MoveEvaluator;

/**
 * 1. idéer till api:
 * pick a card and place in grid, show suggestion
 * 2. pick one full grid based on suggestions and evaluate points
 * 3. pick a card show picked card, show possible cards, show suggestion
 * 4. register as user and show username and password hash
 * 5. login as a user and show userdata
 * 6. Show current game status
 *
 */
class ApiGame
{
    private Grid $player;
    private Deck $deck;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->player = new Grid();
        $deck = new Deck();
        $deck->shuffle();
        $this->deck = $deck;
    }

    /**
     * @return array<mixed>
     */
    public function oneRound(MoveEvaluator $evaluator = new MoveEvaluator(), GridGraphic $gridGraphic = new GridGraphic()): array
    {
        if ($this->player->getCardCount() === 25) {
            $this->reset();
        }
        $card = $this->deck->deal();
        $deck = array_slice($this->deck->getCards(), 26);
        $suggestion = $evaluator->suggestion($this->player->getCards(), $card, $deck);
        $slot = $suggestion['slot'];
        /**
         * @var array<int> $slot
         */
        $this->player->addCard($slot[0], $slot[1], $card);

        $data = [
            'placed cards' => $this->player->getCardCount(),
            "picked card" => $card,
            "suggestion" => $suggestion,
            "grid" => $gridGraphic->graphic($this->player->getCards()),
            "remaining cards" => $this->deck->getCards(),
            "possible cards" => $deck,
        ];
        $data['suggestion']['slot'] = [
            'row' => $slot[0],
            'col' => $slot[1]
        ];
        return $data;
    }
}
