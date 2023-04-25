<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Guess.
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
        $this->assertInstanceOf("\App\Cards\Player", $this->player);

        $res = $this->player->getName();
        $exp = 'Julia';
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the draw method, draws 1 card when there is
     * enough cards left in deck and checks the expected returns from methods
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
     * Tests the add method, draws 5 cards and checks the expected returns from methods
     */
    public function testDrawManyOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $card2 = new CardGraphic("D", "2");
        $card3 = new CardGraphic("H", "A");
        $card4 = new CardGraphic("C", "K");
        $card5 = new CardGraphic("S", "A");
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5));


        $this->player->drawMany($deck, 5);

        $res = $this->player->showHandAsString();
        $exp = [
            "Jack Spades",
            "2 Diamonds",
            "Ace Hearts",
            "King Clubs",
            "Ace Spades",
        ];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [
            [
            'link'=>"img/cards/JS.svg",
            'descr'=>"Jack Spades",
            ],
            [
                'link'=>"img/cards/2D.svg",
                'descr'=>"2 Diamonds",
            ],
            [
                'link'=>"img/cards/AH.svg",
                'descr'=>"Ace Hearts",
            ],
            [
                'link'=>"img/cards/KC.svg",
                'descr'=>"King Clubs",
            ],
            [
                'link'=>"img/cards/AS.svg",
                'descr'=>"Ace Spades",
            ],

        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, tries to draw 5 cards when there is
     * 1 card left in deck and checks the expected returns from methods
     */
    public function testDrawManyNotOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException())));

        $this->player->drawMany($deck, 5);

        $res = $this->player->showHandGraphic();
        $exp = [[
            'link'=>"img/cards/JS.svg",
            'descr'=>"Jack Spades",
        ]];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = ["Jack Spades"];
        $this->assertEquals($exp, $res);
    }
}
