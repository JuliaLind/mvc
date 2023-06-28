<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

class JsonGame21HelperTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new JsonGame21Helper();
        $this->assertInstanceOf("\App\Game\JsonGame21Helper", $gameHandler);
    }

    /**
     * Tests the jsonGame method if a game object
     * is passed as argument
     */
    public function testJsonGame(): void
    {
        $gameHandler = new JsonGame21Helper();
        $game = $this->createMock(Game21Easy::class);
        $game->method('getRisk')->willReturn("47.83%");
        $game->method('getPlayerData')->willReturn([
            [
                'name' => 'player1',
                'cards' => [],
                'money' => 30,
                'handValue' => 20,
            ],
            [
                'name' => 'player2',
                'cards' => [],
                'money' => 90,
                'handValue' => 0,
            ]
        ]);
        $game->method('getGameStatus')->willReturn([
            'bankPlaying'=>true,
            'winner'=>'test player',
            'cardsLeft'=>10,
            'finished'=>false,
            'currentRound'=>7,
            'moneyPot'=>40,
            'roundOver'=>true,
            'level' => 'easy',
        ]);

        $exp = [
            'players' => [[
                'name' => 'player1',
                'cards' => [],
                'money' => 30,
                'handValue' => 20,
            ],
            [
                'name' => 'player2',
                'cards' => [],
                'money' => 90,
                'handValue' => 0,
            ]],
            'status' => [
                'bankPlaying'=>true,
                'winner'=>'test player',
                'cardsLeft'=>10,
                'finished'=>false,
                'currentRound'=>7,
                'moneyPot'=>40,
                'roundOver'=>true,
                'level' => 'easy',
                'risk' => '47.83%'
            ]
        ];
        $res = $gameHandler->jsonGame($game);
        $this->assertEquals($exp, $res);
    }
}
