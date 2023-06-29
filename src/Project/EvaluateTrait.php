<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\EntityManagerInterface;
use App\ProjectRules\WinEvaluator;
use App\ProjectGrid\Grid;
use App\ProjectCard\Deck;

trait EvaluateTrait
{
    private Grid $player;
    private Grid $house;
    private Deck $deck;
    private int $pot=0;
    private string $message = "";
    /**
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];
    /**
     * @var array<string,array<int,int|string>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];

    public function evaluate(EntityManagerInterface $manager, int $userId, WinEvaluator $evaluator=new WinEvaluator(), RegisterFactory $factory = new RegisterFactory()): void
    {
        $this->suggestion = ['message' => ""];

        $playerData = $evaluator->results($this->player->getCards());
        /**
         * @var int $playerTotal
         */
        $playerTotal = $playerData['total'];
        $houseData = $evaluator->results($this->house->getCards());
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
            $register->transaction($amount, 'return (bet x 2)');
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
