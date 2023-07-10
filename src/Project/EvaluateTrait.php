<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\EntityManagerInterface;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Evaluates the hands of player and house after
 * both grids have been filled and determins
 * winner. If player won transfers 2x pot to
 * player/user and registers players score to database.
 */
trait EvaluateTrait
{
    private Grid $player;
    private Grid $house;
    private int $pot=0;
    private string $message = "";
    private RuleEvaluator $evaluator;

    /**
     * The results for the player and the house.
     * Contains the rule scored and the points
     * for each of the 10 hands and the totals
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];

    /**
     * Contains suggestion data for the player,
     * from the latest round. Suggested slot,
     * best possible rules that can be scored in
     * the slot with the dalt card horizontally
     * and vertically and for each of the 10
     * hands best rule that can be scored with
     * dealt card and best rule that can be
     * scored without the dealt card
     * @var array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    private array $suggestion = [];

    /**
     * Called after the last slot in the houses
     * grid has been filled. Determins results
     * and winner. If player wins registers
     * a transaction of pot x 2 and score to
     * the database
     */
    public function evaluate(EntityManagerInterface $manager, int $userId, RegisterFactory $factory = new RegisterFactory()): void
    {
        // $this->suggestion = ['message' => ""];
        $this->suggestion = [];
        $evaluator = $this->evaluator;
        $playerData = $evaluator->results($this->player);
        /**
         * @var int $playerTotal
         */
        $playerTotal = $playerData['total'];
        $houseData = $evaluator->results($this->house);
        /**
         * @var int $houseTotal
         */
        $houseTotal = $houseData['total'];
        $winner = "House";
        $lastPart = "";

        if ($playerTotal >= $houseTotal) {
            $winner = "You";
            $amount = $this->pot * 2;
            $lastPart = " and received {$amount} coins";

            $register = $factory->create($manager, $userId);
            $register->transaction($amount, 'Return (bet x 2)');
            $register->score($playerTotal);
        }
        $this->message = "Game finished, You got {$playerTotal} points and House got {$houseTotal} points. {$winner} won{$lastPart}";
        $this->results = [
            'player' => $playerData,
            'house' => $houseData
        ];
        $this->pot = 0;
    }
}
