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
        $this->assertEmpty($res);

        $res = $this->cardHand->getAsString();
        $this->assertEmpty($res);

        $res = $this->cardHand->getValues();
        $this->assertEmpty($res);

        $res = $this->cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 1 card
     */
    public function testAddOneCardOk(): void
    {
        # Arrange
        $deck = $this->createMock(DeckOfCards::class);
        $card = $this->createMock(CardGraphic::class);

        # Assert
        $deck->expects($this->once())
            ->method('draw');

        $deck->method('draw')->willReturn($card);

        # Act
        $this->cardHand->add($deck, 1);

        # Assert
        $res = $this->cardHand->getCardCount();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getValues method
     */
    public function testGetValues(): void
    {
        # Arrange
        $cardMocks = [];
        for ($i = 2; $i <= 7; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getIntValue')->willReturn($i);
            $cardMocks[] = $card;
        }

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));
        $this->cardHand->add($deck, 6);


        # Act
        $res = $this->cardHand->getValues();

        # Assert
        $exp = [2, 3, 4, 5, 6, 7];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getAsString method
     */
    public function testGetAsString(): void
    {
        # Arrange
        $cardMocks = [];
        for ($i = 2; $i <= 7; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getAsString')->willReturn(strVal($i));
            $cardMocks[] = $card;
        }
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));
        $this->cardHand->add($deck, 6);


        # Act
        $res = $this->cardHand->getAsString();

        # Assert
        $exp = ['2', '3', '4', '5', '6', '7'];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getImgLinksAndDescr method
     */
    public function testGetImgLinksAndDescr(): void
    {
        # Arrange
        $exp = [];
        $cardMocks = [];
        for ($i = 2; $i <= 7; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getAsString')->willReturn(strVal($i));
            $card->method('getImgLink')->willReturn(strVal($i).'.svg');
            $cardMocks[] = $card;
            $exp[] = [
                'link' => strVal($i).'.svg',
                'descr' => strVal($i),
            ];
        }
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));
        $this->cardHand->add($deck, 6);

        # Act
        $res = $this->cardHand->getImgLinksAndDescr();

        # Assert
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the add method, draws 5 cards
     */
    public function testAddManyCardsOk(): void
    {
        # Arrange
        $deck = $this->createMock(DeckOfCards::class);

        # Assert
        $deck->expects($this->exactly(5))
            ->method('draw');

        # Act
        $this->cardHand->add($deck, 5);
    }
    /**
     * Tests the add method, tries to draw 5 cards when there is
     * only 2 cards left in deck
     */
    public function testAddManyCardsNotOk(): void
    {
        # Arrange
        $deck = $this->createMock(DeckOfCards::class);
        $card = $this->createMock(CardGraphic::class);
        $deck->method('draw')->will($this->onConsecutiveCalls($card, clone $card, $this->throwException(new NoCardsLeftException())));

        # Assert
        $deck->expects($this->exactly(3))
            ->method('draw');

        # Act
        $this->cardHand->add($deck, 5);
    }



    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testEmptyHandOk(): void
    {
        # Arrange
        $cardMocks = [];
        $card = $this->createMock(CardGraphic::class);
        $count = 4;
        while (--$count >= 0) {
            $cardMocks[] = clone $card;
        }
        $cardMocks[] = $card;

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));

        $this->cardHand->add($deck, 5);

        $res = $this->cardHand->getCardCount();
        $exp = 5;
        $this->assertEquals($exp, $res);

        # Act
        $this->cardHand->emptyHand();

        # Assert
        $res = $this->cardHand->getCardCount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
