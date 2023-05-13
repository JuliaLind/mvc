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
        $parser->expects($this->once())->method('getParsedText')->with($this->equalTo("markdown/game21.md"))->willReturn("This is a test");

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main(null, $parser);
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
        $parser->expects($this->once())->method('getParsedText')->with($this->equalTo("markdown/game21.md"))->willReturn("This is a test");
        $game = $this->createMock(Game21Easy::class);
        $game->method('gameOver')->willReturn(true);

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main($game, $parser);
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
        $parser->expects($this->once())->method('getParsedText')->with($this->equalTo("markdown/game21.md"))->willReturn("This is a test");
        $game = $this->createMock(Game21Easy::class);
        $game->method('gameOver')->willReturn(false);

        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->main($game, $parser);
        $exp = [
            'about' => "This is a test",
            'page' => "game",
            'url' => "/game",
            'finished' => false,
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests doc method
     */
    public function testDoc(): void
    {
        $parser = $this->createMock(MdParser::class);
        $parser->expects($this->once())->method('getParsedText')->with($this->equalTo("markdown/doc.md"))->willReturn("This is a test");


        $gameHandler = new GameHandlerLanding();
        $res = $gameHandler->doc($parser);
        $exp = [
            'about' => "This is a test",
            'page' => "landing doc",
            'url' => "/game"
        ];
        $this->assertEquals($exp, $res);
    }
}
