<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for PlayerCreator class
 */
class PlayerCreatorTest extends TestCase
{
    /**
     * Construct one of the "ordinary" cards and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $creator = new PlayerCreator();
        $this->assertInstanceOf("\App\Cards\playerCreator", $creator);
    }


    /**
     * Tests the createPlayers method
     */
    public function testCreatePlayers(): void
    {
        $creator = new PlayerCreator();
        $players = $creator->createPlayers(3);

        $res = count($players);
        $exp = 3;
        $this->assertEquals($exp, $res);

        foreach($players as $player) {
            $this->assertInstanceOf("\App\Cards\Player", $player);
        }
    }
}
