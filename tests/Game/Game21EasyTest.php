<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

use App\Cards\DeckOfCards;
use App\Cards\CardGraphic;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Game.
 */
class Game21EasyTest extends TestCase
{
    /**
     * Construct object and check that properties have
     * correct starting values by asserting outcome
     * from getGameStatus method
     */
    public function testCreateObject(): void
    {
        $game = new Game21Easy();
        $this->assertInstanceOf("\App\Game\Game21Easy", $game);

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => false,
            'winner' => '',
            'cardsLeft' => 52,
            'risk'=> '0 %',
            'finished'=> false,
            'currentRound'=> 0,
            'moneyPot' => 0,
            'roundOver' => false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);

        $res = $game->getPlayerData();
        $exp = [
            [
                'name' => 'Bank',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ],
            [
                'name' => 'You',
                'cards' => [],
                'money' => 100,
                'handValue' => 0,
            ]
            ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the deal method
     */
    public function testDeal(): void
    {
        $card = $this->createMock(CardGraphic::class);
        $card->method('getIntValue')->willReturn(10);
        $card->method('getAsString')->willReturn('mocked card');
        $card->method('getImgLink')->willReturn('linkToMockedCard');

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->willReturn($card);

        $game = new Game21Easy(new Player21('You'), $deck);
        $game->deal();
        $res = $game->getPlayerData();
        $exp = [
                [
                    'name' => 'Bank',
                    'cards' => [],
                    'money' => 100,
                    'handValue' => 0,
                ],
                [
                    'name' => 'You',
                    'cards' => [[
                        'link' => 'linkToMockedCard',
                        'descr' => 'mocked card',
                    ]],
                    'money' => 100,
                    'handValue' => 10,
                ]
            ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the dealBank method
     */
    public function testDealBank(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $card = $this->createMock(CardGraphic::class);
        $card2 = clone $card;
        $card3 = clone $card;
        $card4 = clone $card;
        $card5 = clone $card;
        $card6 = clone $card;
        $card7 = clone $card;
        $card->method('getIntValue')->willReturn(14);
        $card2->method('getIntValue')->willReturn(3);
        $card3->method('getIntValue')->willReturn(14);
        $card4->method('getIntValue')->willReturn(14);
        $card5->method('getIntValue')->willReturn(14);
        $card6->method('getIntValue')->willReturn(3);
        $card7->method('getIntValue')->willReturn(7);

        $deck->method('draw')->will($this->onConsecutiveCalls($card, $card2, $card3, $card4, $card5, $card6, $card7));
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(7, 6, 5, 4, 3, 2, 1, 0));

        $game = new Game21Easy(new Player21('You'), $deck);
        $game->dealBank();
        $res = $game->getPlayerData()[0]['handValue'];
        $exp = 14 + 3;
        $this->assertEquals($exp, $res);

        $game = new Game21Easy(new Player21('You'), $deck);
        $game->dealBank();
        $res = $game->getPlayerData()[0]['handValue'];
        $exp = 14 + 1 + 1 + 3;
        $this->assertEquals($exp, $res);

        $game = new Game21Easy(new Player21('You'), $deck);
        $game->dealBank();
        $res = $game->getPlayerData()[0]['handValue'];
        $exp = 7;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the nextRound method that properties are updated correctly
     */
    public function testNextRoundUpdates(): void
    {
        $game = new Game21Easy();
        $game->deal();
        $game->dealBank();

        $playerData = $game->getPlayerData();
        $gameStatus = $game->getGameStatus();


        $bankHandValue = $playerData[0]['handValue'];
        $playerHandValue = $playerData[1]['handValue'];
        $this->assertGreaterThan(0, $bankHandValue);
        $this->assertGreaterThan(0, $playerHandValue);
        $this->assertTrue($gameStatus['bankPlaying']);

        $game->nextRound();
        $gameStatus = $game->getGameStatus();
        $playerData = $game->getPlayerData();
        $bankHandValue = $playerData[0]['handValue'];
        $playerHandValue = $playerData[1]['handValue'];
        $this->assertEquals(0, $bankHandValue);
        $this->assertEquals(0, $playerHandValue);
        $this->assertEquals(1, $gameStatus['currentRound']);
        $this->assertFalse($gameStatus['bankPlaying']);

        $game->nextRound();
        $gameStatus = $game->getGameStatus();
        $this->assertEquals(2, $gameStatus['currentRound']);
    }

    /**
     * Tests the nextRound method that correct values are
     * returned
     */
    public function testNextRoundReturnValues(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getMoney')->will($this->onConsecutiveCalls(30, 30, 80, 80));
        $game = new Game21Easy($player);

        $returned = $game->nextRound();
        $this->assertEquals(1, $returned['round']);
        $this->assertEquals(30, $returned['money']);
        $this->assertEquals(30, $returned['limit']);

        $returned = $game->nextRound();
        $this->assertEquals(2, $returned['round']);
        $this->assertEquals(80, $returned['money']);
        $this->assertEquals(80, $returned['limit']);
    }
}
