<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    private Player $player;

    protected function setUp(): void
    {
        $this->player = new Player('Julia');
    }
    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Cards\Player", $this->player);

        $res = $this->player->getName();
        $exp = 'Julia';
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = [];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the draw method, draws 1 card when there is
     * enough cards left in deck and checks the expected returns from methods
     */
    public function testDrawOk(): void
    {
        $card = $this->createMock(CardGraphic::class);
        $card->method('getAsString')->willReturn('I am a mock');
        $card->method('getImgLink')->willReturn('linkToMock');

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->willReturn($card);


        $this->player->draw($deck);

        $res = $this->player->showHandAsString();
        $exp = ['I am a mock'];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandGraphic();
        $exp = [[
            'link'=>'linkToMock',
            'descr'=>'I am a mock',
        ]];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the drawMany method, draws 5 cards and checks the expected returns from methods
     */
    public function testDrawManyOk(): void
    {

        $cardMocks = [];
        $exp1 = [];
        $exp2 = [];

        for ($i = 1; $i <= 5; $i++) {
            $card = $this->createMock(CardGraphic::class);
            $card->method('getAsString')->willReturn("mock {$i}");
            $card->method('getImgLink')->willReturn("linkToMock{$i}");
            $cardMocks[] = $card;

            $exp1[] = "mock {$i}";
            $exp2[] = [
                'link'=>"linkToMock{$i}",
                'descr'=>"mock {$i}",
            ];
        }

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls(...$cardMocks));
        $this->player->drawMany($deck, 5);

        $res = $this->player->showHandAsString();
        $this->assertEquals($exp1, $res);

        $res = $this->player->showHandGraphic();
        $this->assertEquals($exp2, $res);
    }

    /**
     * Tests the drawMany method, tries to draw 5 cards when there is
     * 1 card left in deck and checks the expected returns from methods
     */
    public function testDrawManyNotOk(): void
    {
        $card = $this->createMock(CardGraphic::class);
        $card->method('getAsString')->willReturn('I am a mock');
        $card->method('getImgLink')->willReturn('linkToMock');

        $deck = $this->createMock(DeckOfCards::class);
        $deck->method('draw')->will($this->onConsecutiveCalls($card, $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException()), $this->throwException(new NoCardsLeftException())));

        $this->player->drawMany($deck, 5);

        $res = $this->player->showHandGraphic();
        $exp = [[
            'link'=>"linkToMock",
            'descr'=>"I am a mock",
        ]];
        $this->assertEquals($exp, $res);

        $res = $this->player->showHandAsString();
        $exp = ["I am a mock"];
        $this->assertEquals($exp, $res);
    }
}
