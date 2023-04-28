<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;
use App\Cards\CardGraphic;
use App\Cards\DeckOfCards;

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
        // $player = new Player('Julia');
        $this->assertInstanceOf("\App\Game\Player", $this->player);

        $res = $this->player->getName();
        $exp = 'Julia';
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->player->getMoney();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $this->player->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $this->player->getCardValues();
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the draw method, draws 1 card when there is
     * enough cards left in deck and checks the expected
     * returns from methods
     */
    public function testDrawOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $deck->method('draw')->willReturn($card);


        $this->player->draw($deck);

        $res = $this->player->showHandAsString();
        $exp = ["Jack Spades"];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [[
            'link'=>"img/cards/JS.svg",
            'descr'=>"Jack Spades",
        ]];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the draw method, tries to draw one card when there
     * are no cards left in deck and checks the expected
     * returns from methods
     */
    public function testDrawNotOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->throwException(new NoCardsLeftException()));

        $this->player->draw($deck);

        $res = $this->player->showHandGraphic();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the incrMoney method
     */
    public function testIncrMoneyOk(): void
    {
        $this->player->incrMoney(20);

        $res = $this->player->getMoney();
        $exp = 20;
        $this->assertEquals($exp, $res);

        $this->player->incrMoney(15);

        $res = $this->player->getMoney();
        $exp = 35;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the decrMoney method
     */
    public function testDecrMoneyOk(): void
    {
        $this->player->decrMoney(20);

        $res = $this->player->getMoney();
        $exp = -20;
        $this->assertEquals($exp, $res);

        $this->player->incrMoney(100);
        $this->player->decrMoney(15);

        $res = $this->player->getMoney();
        $exp = 65;
        $this->assertEquals($exp, $res);
    }

    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testEmptyHandOk(): void
    {


        $deck = $this->createMock(DeckOfCards::class);
        $cardValues = [11, 2, 14, 13, 14];
        $cards = [];
        foreach($cardValues as $value) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getIntValue')->willReturn($value);
            $cards[] = $card;
        }
        // $card = new CardGraphic("S", "J");
        // $card2 = new CardGraphic("D", "2");
        // $card3 = new CardGraphic("H", "A");
        // $card4 = new CardGraphic("C", "K");
        // $card5 = new CardGraphic("S", "A");
        // $deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5));
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cards));

        $loops = 5;
        while (--$loops >= 0) {
            $this->player->draw($deck);
        }

        $res = $this->player->getCardValues();
        // $exp = [11, 2, 14, 13, 14];
        $this->assertEquals($cardValues, $res);

        $this->player->emptyHand();

        $res = $this->player->getCardValues();
        $exp = [];
        $this->assertEquals($exp, $res);
    }
}
