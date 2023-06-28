<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;
use App\Cards\DeckOfCards;

class EvaluatePlayerTraitTest extends TestCase
{
    use EvaluatePlayerTrait;


    public function testEvaluate(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(31);
        $deck = $this->createMock(DeckOfCards::class);
        $this->player = $player;
        $this->bank = $bank;
        $this->deck = $deck;
        $res = $this->evaluate();
        $this->assertTrue($res);
        $this->assertSame($bank, $this->winner);
    }

    public function testEvaluate2(): void
    {
        $dummy = $this->createMock(Player21::class);
        $this->winner = $dummy;
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(17);
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(4) ;
        $this->player = $player;
        $this->bank = $bank;
        $this->deck = $deck;
        $res = $this->evaluate();
        $this->assertFalse($res);
        $this->assertNotSame($bank, $this->winner);
        $this->assertNotSame($player, $this->winner);
        $this->assertSame($dummy, $this->winner);
    }

    public function testEvaluate3(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(17);
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(0) ;
        $this->player = $player;
        $this->bank = $bank;
        $this->deck = $deck;
        $res = $this->evaluate();
        $this->assertTrue($res);
    }
}
