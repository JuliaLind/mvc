<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameHandler.
 */
class GameInitiatorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $gameHandler = new GameInitiator();
        $this->assertInstanceOf("\App\Game\GameInitiator", $gameHandler);
    }


    /**
     * Tests the init method
     */
    public function testInit(): void
    {
        $gameHandler = new GameInitiator();
        $game = $gameHandler->init(1);
        $this->assertInstanceOf("\App\Game\Game21Easy", $game);

        $game = $gameHandler->init(2);
        $this->assertInstanceOf("\App\Game\Game21Hard", $game);
    }
}
