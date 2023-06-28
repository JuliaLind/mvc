<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

/**
 * Test cases for trait BettingGameTrait.
 */
class Game21DataTraitTest extends TestCase
{
    use Game21DataTrait;


    public function testGetPlayerData(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('getName')->willReturn('Julia');
        $bank->method('getName')->willReturn('Bank');
        $player->method('getMoney')->willReturn(70);
        $player->method('handValue')->willReturn(14);
        $bank->method('getMoney')->willReturn(10);
        $bank->method('handValue')->willReturn(18);
        $player->expects($this->once())->method('showHandGraphic')->willReturn([]);
        $bank->expects($this->once())->method('showHandGraphic')->willReturn([]);
        $this->bank = $bank;
        $this->player = $player;

        $exp = [
            [
                'name' => 'Bank',
                'cards' => [],
                'money' => 10,
                'handValue' => 18,
            ],
            [
                'name' => 'Julia',
                'cards' => [],
                'money' => 70,
                'handValue' => 14,
            ]
        ];
        $res = $this->getPlayerData();
        $this->assertEquals($exp, $res);
    }

    public function testGetGameStatus(): void
    {
        $winner = $this->createMock(Player21::class);
        $winner->method('getName')->willReturn('Peter');
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(8);
        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->willReturn(30);
        $this->moneyPot = $pot;
        $this->winner = $winner;
        $this->deck = $deck;
        $this->bankPlaying = true;
        $this->finished = true;
        $this->currentRound = 9;
        $this->roundOver = true;
        $this->level = "hard";
        $exp = [
            'bankPlaying' => true,
            'winner' => "Peter",
            'cardsLeft' => 8,
            'finished' => true,
            'currentRound' => 9,
            'moneyPot' => 30,
            'roundOver' => true,
            'level' => "hard",
        ];
        $res = $this->getGameStatus();
        $this->assertEquals($exp, $res);
    }
}
