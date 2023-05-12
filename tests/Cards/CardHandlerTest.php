<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for CardHandles class
 */
class CardHandlerTest extends TestCase
{
    /**
     * Construct one of the "ordinary" cards and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $cardHandler = new CardHandler();
        $this->assertInstanceOf("\App\Cards\CardHandler", $cardHandler);
    }

    /**
     * Tests that getRouteData method returns correct data
     */
    public function testGetDeckRouteData(): void
    {
        $cardHandler = new CardHandler();
        $deck = $this->createMock(DeckOfCards::class);
        $deck->expects($this->once())
            ->method('getImgLinks')
            ->willReturn(['alink.png', 'anotherlink.png']);
        $exp = [
            'title' => "Sorted deck",
            'cards' => ['alink.png', 'anotherlink.png'],
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        $res = $cardHandler->getDeckRouteData($deck);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that getDataForDraw method returns correct data
     * when one card is drawn
     */
    public function testGetDataForDrawOneCard(): void
    {
        $cardHandler = new CardHandler();
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(4);
        $player = $this->createMock(Player::class);
        $player->method('getName')->willReturn('test-player');
        $player->method('showHandGraphic')->willReturn(['alink.png', 'anotherlink.png']);
        $player->expects($this->once())
            ->method('draw');


        $exp = [
            'title' => "Draw 1 cards for 1 players",
            'players' => [[
                'playerName' => 'test-player',
                'cards' => ['alink.png', 'anotherlink.png']
            ]
            ],
            'cardsLeft' => 4,
            'page' => "draw card no-header",
            'url' => "/card",
        ];
        $res = $cardHandler->getDataForDraw($deck, [$player]);
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that getDataForDraw method works properly when more than one card is drawn
     */
    public function testGetDataForDrawManyCards(): void
    {
        $cardHandler = new CardHandler();
        $deck = $this->createMock(DeckOfCards::class);
        $player = $this->createMock(Player::class);
        $player->expects($this->once())->method('draw')->with($deck);
        $player->expects($this->once())->method('drawMany')
        ->with($deck, 7);
        $cardHandler->getDataForDraw($deck, [$player], 8);
    }

    /**
     * Tests that getDataForDraw method works properly when more than one card is drawn and for more than one player
     */
    public function testGetDataForDrawManyCardsManyPlayers(): void
    {
        $cardHandler = new CardHandler();
        $deck = $this->createMock(DeckOfCards::class);
        $players = [];
        for ($i=1; $i<=5; $i++) {
            $player = $this->createMock(Player::class);
            $player->expects($this->once())->method('draw')->with($deck);
            $player->expects($this->once())->method('drawMany')
            ->with($deck, 9);
            $players[] = $player;
            $player->expects($this->once())->method('getName');
            $player->expects($this->once())->method('showHandGraphic');
        }

        $cardHandler->getDataForDraw($deck, $players, 10);
    }
}
