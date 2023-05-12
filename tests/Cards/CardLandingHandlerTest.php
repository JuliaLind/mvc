<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for CardLandingHandler class.
 */
class CardLandingHandlerTest extends TestCase
{
    /**
     * Construct the object
     */
    public function testCreateObject(): void
    {
        $cardHandler = new CardLandingHandler();
        $this->assertInstanceOf("\App\Cards\CardLandingHandler", $cardHandler);
    }

    /**
     * Tests that getMainData method returns correct data
     */
    public function testGetMainData(): void
    {
        $cardHandler = new CardLandingHandler();
        $exp = [
            'page' => "landing",
            'url' => "/card",
            'cardRoutes' => [
                [
                    'link' => "deck",
                    'method' => 'GET',
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                ],
            ],
        ];
        $res = $cardHandler->getMainData();
        $this->assertEquals($exp, $res);
    }
}
