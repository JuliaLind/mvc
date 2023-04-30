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
     * Tests the add method, draws 1 card
     */
    public function testAddOneCardOk(): void
    {
        # Arrange
        $deck = $this->createMock(DeckOfCards::class);

        # Assert
        $deck->expects($this->once())
            ->method('draw');

        # Act
        $this->cardHand->add($deck, 1);
    }

    /**
     * Tests the getValues method
     */
    public function testGetValues(): void
    {
        # Arrange
        $cardMocks = [];
        $count = 5;
        while (--$count >= 0) {
            $card = $this->createMock(CardGraphic::class);

            # Assert
            $card->expects($this->once())
                ->method('getIntValue');

            $cardMocks[] = $card;
        }
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));
        $this->cardHand->add($deck, 5);


        # Act
        $this->cardHand->getValues();
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
