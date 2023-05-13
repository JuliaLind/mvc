<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for class GameHandler.
 */
class GameHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new GameHandler();
        $this->assertInstanceOf("\App\Game\GameHandler", $gameHandler);
    }

    /**
     * Tests the play method
     */
    public function testPlay(): void
    {
        $gameHandler = new GameHandler();
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

        $game->method('generateFlash')->willReturn(["custom", "testing bankDraw"]);
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
            'risk'=> "47.83%",
            'page' => "game no-header card",
            'url' => "/game",
            'title' => 'Game 21'
        ];
        $res = $gameHandler->play($game);
        $this->assertEquals($exp, $res);
    }
}
