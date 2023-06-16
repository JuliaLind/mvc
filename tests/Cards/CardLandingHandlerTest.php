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
                    'route' => '/card/deck'
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                    'route' => '/card/deck/shuffle'
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                    'route' => '/card/deck/draw'
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                    'route' => '/card/deck/draw/5'
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                    'route' => '/card/deck/deal/3/5'
                ],
            ],
        ];
        $res = $cardHandler->getMainData();
        $this->assertEquals($exp, $res);
    }
}
