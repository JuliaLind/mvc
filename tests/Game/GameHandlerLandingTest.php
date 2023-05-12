<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for class Game.
 */
class GameHandlerLandingTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new GameHandlerLanding();
        $this->assertInstanceOf("\App\Game\GameHandlerLanding", $gameHandler);
    }

    /**
     * Tests main method if no ongoing game
     */
    public function testMainNoGame(): void
    {
        $parser = $this->createMock(MdParser::class);
        $parser->method('getParsedText')->willReturn("This is a test");

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main($parser, null);
        $exp = [
            'about' => "This is a test",
            'page' => "game",
            'url' => "/game",
            'finished' => true,
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests main method if ongoing game and the game is finished
     */
    public function testMainGameFinished(): void
    {
        $parser = $this->createMock(MdParser::class);
        $parser->method('getParsedText')->willReturn("This is a test");
        $game = $this->createMock(Game21Easy::class);
        $game->method('gameOver')->willReturn(true);

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main($parser, $game);
        $exp = [
            'about' => "This is a test",
            'page' => "game",
            'url' => "/game",
            'finished' => true,
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests main method if ongoing game and the game is not finished
     */
    public function testMainGameNotFinished(): void
    {
        $parser = $this->createMock(MdParser::class);
        $parser->method('getParsedText')->willReturn("This is a test");
        $game = $this->createMock(Game21Easy::class);
        $game->method('gameOver')->willReturn(false);

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main($parser, $game);
        $exp = [
            'about' => "This is a test",
            'page' => "game",
            'url' => "/game",
            'finished' => false,
        ];
        $this->assertEquals($exp, $res);
    }
}
