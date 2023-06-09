<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\NoCardsLeftException;
use App\Cards\CardGraphic;
use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Test cases for PlayerTrait.
 */
class PlayerTraitTest extends TestCase
{
    use PlayerTrait;

    /**
     * Tests the draw method
     */
    public function testDraw(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $hand = $this->createMock(CardHand::class);
        $this->hand = $hand;

        $hand->expects($this->once())
                ->method('add')
                ->with($this->equalTo($deck), $this->equalTo(1));

        $this->draw($deck);
    }

    /**
     * Draws 5 cards, emtpies hand and checks the expected returns from methods
     */
    public function testEmptyHandOk(): void
    {
        $hand = $this->createMock(CardHand::class);
        $this->hand = $hand;

        $hand->expects($this->once())
                ->method('emptyHand');

        $this->emptyHand();
    }

    /**
     * Tests getCardValue method
     */
    public function testGetCardValues(): void
    {
        $hand = $this->createMock(CardHand::class);
        $this->hand = $hand;

        $hand->expects($this->once())
                ->method('getValues');

        $this->getCardValues();
    }

    /**
     * Tests showHandAsString method
     */
    public function testShowHandAsString(): void
    {
        $hand = $this->createMock(CardHand::class);
        $this->hand = $hand;

        $hand->expects($this->once())
                ->method('getAsString');

        $this->showHandAsString();
    }

    /**
     * Tests getCardCount method
     */
    public function testGetCardCount(): void
    {
        $hand = $this->createMock(CardHand::class);
        $this->hand = $hand;

        $hand->expects($this->once())
                ->method('getCardCount');

        $this->getCardCount();
    }
}
