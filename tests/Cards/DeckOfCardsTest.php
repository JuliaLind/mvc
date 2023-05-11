<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Cards\NoCardsLeftException;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        $res = $deck->getCardCount();
        $exp = 52;
        $this->assertEquals($exp, $res);

        $res = $deck->getValues();
        $exp = [];
        $loops = 4;
        while (--$loops >= 0) {
            for ($i = 2; $i <= 14; $i++) {
                $exp[] = $i;
            }
        }
        $this->assertEquals($exp, $res);

        $card = $deck->draw();
        $this->assertInstanceOf("\App\Cards\CardGraphic", $card);
    }

    /**
     * Construct deck and checks that the drawn card is the last card in deck
     */
    public function testDrawOk(): void
    {
        # Arrange
        $deck = new DeckOfCards();
        $card = $this->createMock(CardGraphic::class);
        $card2 = $this->createMock(CardGraphic::class);
        $card3 = $this->createMock(CardGraphic::class);
        $deck->setCards([$card, $card2, $card3]);

        # Act
        $res = $deck->draw();

        #Assert
        $exp = $card3;
        $this->assertSame($exp, $res);
    }

    /**
     * Construct deck and checks that NoCardsLeftException is
     * thrown when try to draw more cards then there
     * are in deck
     */
    public function testDrawNotOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 53;
        $this->expectException(NoCardsLeftException::class);
        while (--$loops >= 0) {
            $deck->draw();
        }

        $exp = 0;
        $res = $deck->getCardCount();
        $this->assertEquals($exp, $res);

    }

    /**
     * Construct deck, draw 7 cards and check that
     * remaining number of cards is 45
     */
    public function testCardCountOk(): void
    {
        $deck = new DeckOfCards();
        $card = $this->createMock(CardGraphic::class);
        $card2 = $this->createMock(CardGraphic::class);
        $card3 = $this->createMock(CardGraphic::class);
        $deck->setCards([$card, $card2, $card3]);

        $exp = 3;
        $res = $deck->getCardCount();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, and checks that getAsString() method
     * returns array with expected string values
     */
    public function testGetAsStringOk(): void
    {
        # Arrange
        $deck = new DeckOfCards();
        $cardMocks = [];
        $count = 5;
        while (--$count >= 0) {
            $card = $this->createMock(CardGraphic::class);

            # Assert
            $card->expects($this->once())
                ->method('getAsString');

            $cardMocks[] = $card;
        }
        $deck->setCards($cardMocks);

        # Act
        $deck->getAsString();
    }

    /**
     * Construct deck, empties it and checks that
     * getAsString() method returns empty array
     */
    public function testGetAsStringNotOk(): void
    {
        $deck = new DeckOfCards();

        $loops = 52;
        while (--$loops >= 0) {
            $deck->draw();
        }

        $res = $deck->getAsString();
        $this->assertEmpty($res);
    }

    /**
     * Construct deck, and checks that getImgLinks() method
     * returns array with expected string values
     */
    public function testGetImgLinksOk(): void
    {
        # Arrange
        $deck = new DeckOfCards();
        $cardMocks = [];
        $count = 5;
        while (--$count >= 0) {
            $card = $this->createMock(CardGraphic::class);

            # Assert
            $card->expects($this->once())
                ->method('getImgLink');

            $cardMocks[] = $card;
        }
        $deck->setCards($cardMocks);

        # Act
        $deck->getImgLinks();

    }

    /**
     * Construct deck, empties it and checks that
     * getImgLinks() method returns empty array
     */
    public function testGetImgLinksNotOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 52;
        while (--$loops >= 0) {
            $deck->draw();
        }

        $res = $deck->getImgLinks();
        $this->assertEmpty($res);
    }

    /**
     * Construct deck, and checks that shuffle method
     * only changes the order of cards
     */
    public function testShuffleOk(): void
    {
        $deck = new DeckOfCards();
        $exp = [];
        foreach ([' Diamonds', ' Hearts', ' Clubs', ' Spades'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $exp[] = strval($i) . $suit;
            }
            foreach (['Jack', 'Queen', 'King', 'Ace'] as $rank) {
                $exp[] = $rank . $suit;
            }
        }
        $deck->shuffle();

        $res = $deck->getAsString();
        $this->assertNotEquals($exp, $res);
        $this->assertEqualsCanonicalizing($exp, $res);
    }
}
