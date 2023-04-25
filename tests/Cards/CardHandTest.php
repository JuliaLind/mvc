<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Guess.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct empty CardHand and check that all metods return empty arrays and card count method
     * returns 0
     */
    public function testCreateObject(): void
    {
        $cardHand = new CardHand();
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        $res = $cardHand->getImgLinks();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getImgLinksAndDescr();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getAsString();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getValues();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 1 card when there is
     * enough cards left in deck and checks the expected returns from methods
     */
    public function testAddOneCardOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $deck->method('draw')->willReturn($card);

        $cardHand = new CardHand();
        $cardHand->add($deck, 1);

        $res = $cardHand->getImgLinks();
        $exp = ["img/cards/JS.svg"];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getImgLinksAndDescr();
        $exp = [[
            'link'=>"img/cards/JS.svg",
            'descr'=>"Jack Spades",
        ]];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getAsString();
        $exp = ["Jack Spades"];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getValues();
        $exp = [11];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getCardCount();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 5 cards and checks the expected returns from methods
     */
    public function testAddManyCardsOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $card2 = new CardGraphic("D", "2");
        $card3 = new CardGraphic("H", "A");
        $card4 = new CardGraphic("C", "K");
        $card5 = new CardGraphic("S", "A");
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5));

        $cardHand = new CardHand();
        $cardHand->add($deck, 5);

        $res = $cardHand->getImgLinks();
        $exp = [
            "img/cards/JS.svg",
            "img/cards/2D.svg",
            "img/cards/AH.svg",
            "img/cards/KC.svg",
            "img/cards/AS.svg",
        ];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getImgLinksAndDescr();
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

        $res = $cardHand->getAsString();
        $exp = ["Jack Spades", "2 Diamonds", "Ace Hearts", "King Clubs", "Ace Spades"];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getValues();
        $exp = [11, 2, 14, 13, 14];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getCardCount();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }
    /**
     * Tests the add method, tries to draw 5 cards when there is
     * only 1 card left in deck and checks the expected returns from methods
     */
    public function testAddManyCardsNotOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException())));

        $cardHand = new CardHand();
        $cardHand->add($deck, 5);

        $res = $cardHand->getImgLinks();
        $exp = ["img/cards/JS.svg"];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getImgLinksAndDescr();
        $exp = [[
            'link'=>"img/cards/JS.svg",
            'descr'=>"Jack Spades",
        ]];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getAsString();
        $exp = ["Jack Spades"];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getValues();
        $exp = [11];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getCardCount();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }



    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testRemoveOk(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = new CardGraphic("S", "J");
        $card2 = new CardGraphic("D", "2");
        $card3 = new CardGraphic("H", "A");
        $card4 = new CardGraphic("C", "K");
        $card5 = new CardGraphic("S", "A");
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5));

        $cardHand = new CardHand();
        $cardHand->add($deck, 5);
        $res = $cardHand->getCardCount();
        $exp = 5;
        $this->assertEquals($exp, $res);

        $cardHand->emptyHand();

        $res = $cardHand->getImgLinks();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getImgLinksAndDescr();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getAsString();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getValues();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
