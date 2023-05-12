<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;
use App\Cards\CardGraphic;
use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Test cases for class Player.
 */
class PlayerTraitTest extends TestCase
{
    use PlayerTrait;

    // private Player $player;

    // protected function setUp(): void
    // {
    //     # Arrange
    //     $this->player = new Player('Julia');
    // }
    // /**
    //  * Construct object and check that all metods return
    //  * expected properties
    //  */
    // public function testCreateObject(): void
    // {
    //     # Assert
    //     $this->assertInstanceOf("\App\Game\Player", $this->player);

    //     # Assert
    //     $res = $this->player->getName();
    //     $exp = 'Julia';
    //     $this->assertEquals($exp, $res);

    //     # Assert
    //     $res = $this->player->showHandGraphic();
    //     $this->assertEmpty($res);

    //     # Assert
    //     $res = $this->player->showHandAsString();
    //     $this->assertEmpty($res);

    //     # Assert
    //     $res = $this->player->getMoney();
    //     $exp = 0;
    //     $this->assertEquals($exp, $res);

    //     # Assert
    //     $res = $this->player->getCardCount();
    //     $exp = 0;
    //     $this->assertEquals($exp, $res);

    //     # Assert
    //     $res = $this->player->getCardValues();
    //     $this->assertEmpty($res);
    // }

    /**
     * Tests the draw method
     */
    public function testDraw(): void
    {
        # arrange
        $deck = $this->createMock(DeckOfCards::class);
        $hand = $this->createMock(CardHand::class);
        // $player = new Player('', $hand);
        $this->hand = $hand;

        #assert
        $hand->expects($this->once())
                ->method('add')
                ->with($this->equalTo($deck), $this->equalTo(1));

        #act
        // $player->draw($deck);
        $this->draw($deck);
    }

    /**
     * Tests the incrMoney method
     */
    public function testIncrMoneyOk(): void
    {
        // # Act
        // $this->player->incrMoney(20);

        // # Assert
        // $res = $this->player->getMoney();
        // $exp = 20;
        // $this->assertEquals($exp, $res);

        // # Act
        // $this->player->incrMoney(15);

        // # Assert
        // $res = $this->player->getMoney();

        # Act
        $this->incrMoney(20);

        # Assert
        $res = $this->getMoney();
        $exp = 20;
        $this->assertEquals($exp, $res);

        # Act
        $this->incrMoney(15);

        # Assert
        $res = $this->getMoney();

        $exp = 35;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the decrMoney method
     */
    public function testDecrMoneyOk(): void
    {
        // # Act
        // $this->player->decrMoney(20);

        // # Assert
        // $res = $this->player->getMoney();
        // $exp = -20;
        // $this->assertEquals($exp, $res);

        // # Arrange
        // $this->player->incrMoney(100);

        // # Act
        // $this->player->decrMoney(15);

        // # Assert
        // $res = $this->player->getMoney();

        # Act
        $this->decrMoney(20);

        # Assert
        $res = $this->getMoney();
        $exp = -20;
        $this->assertEquals($exp, $res);

        # Arrange
        $this->incrMoney(100);

        # Act
        $this->decrMoney(15);

        # Assert
        $res = $this->getMoney();

        $exp = 65;
        $this->assertEquals($exp, $res);
    }

    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testEmptyHandOk(): void
    {
        # arrange
        $hand = $this->createMock(CardHand::class);
        // $player = new Player('', $hand);
        $this->hand = $hand;

        #assert
        $hand->expects($this->once())
                ->method('emptyHand');

        # Act
        // $player->emptyHand();
        $this->emptyHand();
    }
}
