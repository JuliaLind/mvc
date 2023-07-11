<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class Game21HardTest extends TestCase
{
    /**
     * Construct object and check that properties have
     * correct starting values by asserting outcome
     * from getGameStatus method
     */
    public function testCreateObject(): void
    {
        $game = new Game21Hard();
        $this->assertInstanceOf("\App\Game\Game21Hard", $game);

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => false,
            'winner' => '',
            'cardsLeft' => 52,
            'finished'=> false,
            'currentRound'=> 0,
            'moneyPot' => 0,
            'roundOver' => false,
            'level' => 'hard',
        ];
        $this->assertEquals($exp, $res);

        $res = $game->getPlayerData();
        $exp = [
            [
                'name' => 'Bank',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ],
            [
                'name' => 'You',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ]
            ];
        $this->assertEquals($exp, $res);

        $res = $game->getRisk();
        $exp = '0 %';
        $this->assertEquals($exp, $res);
    }
}
