<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    private Player $player;

    protected function setUp(): void
    {
        $this->player = new Player('Julia');
    }
    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Cards\Player", $this->player);

        $res = $this->player->getName();
        $exp = 'Julia';
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $this->assertEmpty($res);
        ;

        $res = $this->player->showHandAsString();
        $this->assertEmpty($res);
    }

    /**
     * Tests the draw method, draws 1 card when there is
     * enough cards left in deck and checks the expected returns from methods
     */
    public function testDrawOk(): void
    {
        # arrange
        $deck = $this->createMock(DeckOfCards::class);
        $hand = $this->createMock(CardHand::class);
        $player = new Player('', $hand);

        #assert
        $hand->expects($this->once())
                ->method('add')
                ->with($this->equalTo($deck), $this->equalTo(1));

        #act
        $player->draw($deck);
    }

    /**
     * Tests the drawMany method, draws 5 cards and checks the expected returns from methods
     */
    public function testDrawManyOk(): void
    {
        # Arrange
        $deck = $this->createMock(DeckOfCards::class);
        $hand = $this->createMock(CardHand::class);
        $player = new Player('', $hand);

        # Assert
        $hand->expects($this->once())
            ->method('add')
            ->with($this->equalTo($deck), $this->equalTo(5));

        # Act
        $player->drawMany($deck, 5);
    }

    /**
     * Tests the drawMany method, tries to draw 5 cards when there is
     * 1 card left in deck and checks the expected returns from methods
     */
    public function testDrawManyNotOk(): void
    {
        $card = $this->createMock(CardGraphic::class);


        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $this->throwException(new NoCardsLeftException())));
        $hand = $this->createMock(CardHand::class);
        $player = new Player('', $hand);

        # Assert
        $hand->expects($this->once())
            ->method('add')
            ->with($this->equalTo($deck), $this->equalTo(5));

        $player->drawMany($deck, 5);
    }
}
