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

        $res = $game->getRisk();
        $exp = '0 %';
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the deal method
     */
    public function testDeal(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $player = $this->createMock(Player21::class);
        $player->expects($this->once())
                ->method('draw')
                ->with($this->equalTo($deck));

        $game = new Game21Easy($player, $deck);
        $game->deal();
    }

    /**
     * Tests the dealBank method stops dealing when
     * value in hand is 17 pr above
     */
    public function testDealBankCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('getCardCount')->willReturn(1);

        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $bank->method('handValue')->will($this->onConsecutiveCalls(0, 10, 16, 17, 19));

        $bank->expects($this->exactly(3))
                ->method('draw')
                ->with($this->equalTo($deck));

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->dealBank();
    }

    /**
     * Tests that dealBank method stops dealing when no
     * cards left
     */
    public function testDealBankNoCardsLeft(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $bank->method('handValue')->willReturn(10);
        $deck->method('getCardCount')->will($this->onConsecutiveCalls(1, 0));
        $bank->expects($this->once())
                ->method('draw')
                ->with($this->equalTo($deck));
        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->dealBank();
    }


    /**
     * Tests the getRisk() method that correct values are
     * returned when player it's player's turn
     */
    public function testGetRiskPlayer(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('estimateRisk')->willReturn(0.6758);
        $game = new Game21Easy($player);
        $res = $game->getRisk();
        $exp = '67.58 %';
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getRisk() method that correct values are
     * returned when player it's bank's turn
     */
    public function testGetRiskBank(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $player = $this->createMock(Player21::class);
        $bank = clone $player;

        $player->method('estimateRisk')->willReturn(0.6758);
        $bank->method('estimateRisk')->willReturn(0.3389);

        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setBankPlaying(true);

        $res = $game->getRisk();
        $exp = '33.89 %';
        $this->assertEquals($exp, $res);
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

    /**
     * Tests the nextRound method that properties are updated correctly
     */
    public function testNextRoundUpdates(): void
    {
        $deck = $this->createMock(DeckOfCards::class);
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn("the player");

        $bank = $this->createMock(Player21::class);
        $player->expects($this->once())
                ->method('emptyHand');
        $bank->expects($this->once())
                ->method('emptyHand');

        $winner = $player;


        $game = new Game21Easy($player, $deck);
        $game->setBank($bank);
        $game->setBankPlaying(true);
        $game->setRoundOver(true);
        $game->setWinner($winner);

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => true,
            'winner' => 'the player',
            'cardsLeft' => 0,
            'finished'=> false,
            'currentRound'=> 0,
            'moneyPot' => 0,
            'roundOver' => true,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);

        $game->nextRound();

        $res = $game->getGameStatus();
        $exp = [
            'bankPlaying' => false,
            'winner' => '',
            'cardsLeft' => 0,
            'finished'=> false,
            'currentRound'=> 1,
            'moneyPot' => 0,
            'roundOver' => false,
            'level' => 'easy',
        ];
        $this->assertEquals($exp, $res);

    }
}
