<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

class Game21TraitTest extends TestCase
{
    use Game21Trait;


    public function tesCcurrentPlayer(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $this->player = $player;
        $this->bank = $bank;
        $this->bankPlaying = false;
        $res = $this->currentPlayer();
        $exp = $player;
        $this->assertSame($exp, $res);
    }

    public function testCurrentPlayer2(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $this->player = $player;
        $this->bank = $bank;
        $this->bankPlaying = true;
        $res = $this->currentPlayer();
        $exp = $bank;
        $this->assertSame($exp, $res);
    }

    public function testEstimateRisk(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $deck = $this->createMock(DeckOfCards::class);
        $player->expects($this->once())->method('estimateRisk')->with($this->equalTo($deck))->willReturn(0.4893);
        $this->deck = $deck;
        $this->player = $player;
        $this->bank = $bank;
        $exp = '48.93 %';
        $res = $this->getRisk();
        $this->assertEquals($exp, $res);
    }
}
