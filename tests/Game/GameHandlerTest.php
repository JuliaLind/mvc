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
     * Tests the init method
     */
    public function testInit(): void
    {
        $gameHandler = new GameHandler();
        $game = $gameHandler->init(1);
        $this->assertInstanceOf("\App\Game\Game21Easy", $game);

        $game = $gameHandler->init(2);
        $this->assertInstanceOf("\App\Game\Game21Hard", $game);
    }

    /**
     * Tests the selectAmount method
     */
    public function testSelectAmount(): void
    {
        $gameHandler = new GameHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->method('nextRound')->willReturn([
            'limit' => 50,
            'money' => 40,
            'round' => 5,
        ]);

        $exp = [
            'limit' => 50,
            'money' => 40,
            'round' => 5,
            'page' => "game no-header card",
            'url' => "/game",
        ];

        $res = $gameHandler->selectAmount($game);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the bet method
     */
    public function testBet(): void
    {
        $gameHandler = new GameHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('addToMoneyPot')
            ->with($this->equalTo(30));
        $gameHandler->bet(30, $game);
    }

    /**
     * Tests the playerDraw method
     */
    public function testPlayerDraw(): void
    {
        $gameHandler = new GameHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('deal');
        $game->expects($this->once())
            ->method('evaluate');
        $game->expects($this->once())
            ->method('endRound');

        $game->method('generateFlash')->willReturn(["custom", "testing playerDraw"]);
        $exp = ["custom", "testing playerDraw"];
        $res = $gameHandler->playerDraw($game);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the bankDraw method
     */
    public function testBankDraw(): void
    {
        $gameHandler = new GameHandler();
        $game = $this->createMock(Game21Easy::class);
        $game->expects($this->once())
            ->method('dealBank');
        $game->expects($this->once())
            ->method('evaluateBank');
        $game->expects($this->once())
            ->method('endRound');

        $game->method('generateFlash')->willReturn(["custom", "testing bankDraw"]);
        $exp = ["custom", "testing bankDraw"];
        $res = $gameHandler->bankDraw($game);
        $this->assertEquals($exp, $res);
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

    /**
     * Tests the jsonGame method if a game object
     * is passed as argument
     */
    public function testJsonGame(): void
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
