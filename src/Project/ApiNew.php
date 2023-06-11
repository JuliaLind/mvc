<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectCard\Card;


use Symfony\Component\HttpFoundation\Request;

class ApiNew
{
    /**
     * @return array<mixed>
     */
    public function oneRound(Request $request, Grid $grid = new Grid(), Deck $deck = new Deck(), GridGraphic $gridGraphic = new GridGraphic()): array
    {
        $card = $deck->deal();
        /**
         * @var int $row
         */
        $row = $request->get('row');
        /**
         * @var int $col
         */
        $col = $request->get('col');
        $grid->addCard($row, $col, $card);

        return [
            "placement" => "You placed card '{$card->name()}' on row {$row} column {$col}",
            "grid" => $gridGraphic->graphic($grid->getCards()),
            "remaining cards" => $deck->getAsStringArr()
        ];
    }
}
