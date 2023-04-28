<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    private CardHand $cardHand;

    protected function setUp(): void
    {
        $this->cardHand = new CardHand();
    }
    /**
     * Construct empty CardHand and check that all metods return empty arrays and card count method
     * returns 0
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Cards\CardHand", $this->cardHand);

        $res = $this->cardHand->getImgLinksAndDescr();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getAsString();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getValues();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 1 card when there is
     * enough cards left in deck and checks the expected returns from methods
     */
    public function testAddOneCardOk(): void
    {
        $card = $this->createMock(CardGraphic::class);
        $card->method('getAsString')->willReturn('I am a mock');
        $card->method('getImgLink')->willReturn('linkToMock');
        $card->method('getIntValue')->willReturn(11);

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->willReturn($card);

        $this->cardHand->add($deck, 1);

        $res = $this->cardHand->getImgLinksAndDescr();
        $exp = [[
            'link'=>"linkToMock",
            'descr'=>"I am a mock",
        ]];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getAsString();
        $exp = ["I am a mock"];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getValues();
        $exp = [11];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getCardCount();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 5 cards and checks the expected returns from methods
     */
    public function testAddManyCardsOk(): void
    {
        $cardMocks = [];
        $exp1 = [];
        $exp2 = [];
        $exp3 = [];

        for ($i = 1; $i <= 5; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getAsString')->willReturn("mock {$i}");
            $card->method('getImgLink')->willReturn("linkToMock{$i}");
            $card->method('getIntValue')->willReturn($i+1);
            $cardMocks[] = $card;

            $exp1[] = [
                'link'=>"linkToMock{$i}",
                'descr'=>"mock {$i}",
            ];
            $exp2[] = "mock {$i}";
            $exp3[] = $i+1;
        }

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));

        $this->cardHand->add($deck, 5);

        $res = $this->cardHand->getImgLinksAndDescr();
        $this->assertEquals($exp1, $res);

        $res = $this->cardHand->getAsString();
        $this->assertEquals($exp2, $res);

        $res = $this->cardHand->getValues();
        $this->assertEquals($exp3, $res);

        $res = $this->cardHand->getCardCount();
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
        $card = $this->createMock(CardGraphic::class);
        $card->method('getAsString')->willReturn('I am a mock');
        $card->method('getImgLink')->willReturn('linkToMock');
        $card->method('getIntValue')->willReturn(11);

        $deck->method('draw')->will($this->onConsecutiveCalls($card, $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException())));


        $this->cardHand->add($deck, 5);

        $res = $this->cardHand->getImgLinksAndDescr();
        $exp = [[
            'link'=>"linkToMock",
            'descr'=>"I am a mock",
        ]];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getAsString();
        $exp = ["I am a mock"];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getValues();
        $exp = [11];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getCardCount();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }



    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testEmptyHandOk(): void
    {
        $cardMocks = [];

        for ($i = 1; $i <= 5; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getAsString')->willReturn("mock {$i}");
            $card->method('getImgLink')->willReturn("linkToMock{$i}");
            $card->method('getIntValue')->willReturn($i+1);
            $cardMocks[] = $card;
        }

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));

        $this->cardHand->add($deck, 5);

        $res = $this->cardHand->getCardCount();
        $exp = 5;
        $this->assertEquals($exp, $res);

        $this->cardHand->emptyHand();


        $res = $this->cardHand->getImgLinksAndDescr();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getAsString();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getValues();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
