<?php

namespace App\Project;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class EvaluateTraitTest extends KernelTestCase
{
    use EvaluateTrait;


    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        /** @phpstan-ignore-next-line */
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testEvaluatePlayerWon(): void
    {
        $evaluator = $this->createMock(RuleEvaluator::class);
        $house = $this->createMock(Grid::class);
        $player = $this->createMock(Grid::class);
        $factory = $this->createMock(RegisterFactory::class);

        $playerResults = [
            "rows" => [
                // row data player
              ],
            "cols" => [
                // col data player
            ],
            "total" => 100
        ];
        $houseResults = [
            "rows" => [
                // row data house
            ],
            "cols" => [
                // col data house
            ],
            "total" => 999
        ];
        $evaluator->expects($this->exactly(2))->method('results')
        ->will($this->onConsecutiveCalls($playerResults, $houseResults));
        $factory->expects($this->never())->method('create');
        $this->house = $house;
        $this->player = $player;
        $this->evaluator = $evaluator;
        $this->pot = 200;
        $this->evaluate($this->entityManager, 3, $factory);
        $this->assertEquals([
            'player' => $playerResults,
            'house' => $houseResults
        ], $this->results);

        $exp = ["Game finished", "You got 100 points and House got 999 points.", "House won!"];
        $this->assertEquals(
            $exp,
            $this->message
        );
        $this->assertEquals(0, $this->pot);
    }

    public function testEvaluateHouseWon(): void
    {
        $evaluator = $this->createMock(RuleEvaluator::class);
        $house = $this->createMock(Grid::class);
        $player = $this->createMock(Grid::class);
        $factory = $this->createMock(RegisterFactory::class);

        $playerResults = [
            "rows" => [
                // row data player
              ],
            "cols" => [
                // col data player
            ],
            "total" => 374
        ];
        $houseResults = [
            "rows" => [
                // row data house
            ],
            "cols" => [
                // col data house
            ],
            "total" => 10
        ];
        $this->pot = 40;
        $evaluator->expects($this->exactly(2))->method('results')
        ->will($this->onConsecutiveCalls($playerResults, $houseResults));

        $register = $this->createMock(Register::class);
        $register->expects($this->once())->method('transaction')->with($this->equalTo(80), $this->equalTo('Return (bet x 2)'));
        $register->expects($this->once())->method('score')->with($this->equalTo(374));
        $factory->expects($this->once())->method('create')->with($this->equalTo($this->entityManager), $this->equalTo(3))->willReturn($register);
        $this->house = $house;
        $this->player = $player;
        $this->evaluator = $evaluator;

        $this->evaluate($this->entityManager, 3, $factory);
        $this->assertEquals([
            'player' => $playerResults,
            'house' => $houseResults
        ], $this->results);

        $exp = ["Game finished", "You got 374 points and House got 10 points.", "You won and received 80 coins!"];
        $this->assertEquals(
            $exp,
            $this->message
        );
        $this->assertEquals(0, $this->pot);
    }
}
