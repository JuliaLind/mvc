<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

class Game21FlashTraitTest extends TestCase
{
    use Game21FlashTrait;

    public function testMessageType(): void
    {
        $type = $this->messageType("Anna");
        $this->assertEquals("notice", $type);

        $type = $this->messageType("Bank");
        $this->assertEquals("warning", $type);
    }

    public function generateFlashTest(): void
    {
        $this->roundOver = true;
        $this->finished = false;
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn('Julia');
        $this->winner = $player;
        $flash = $this->generateFlash();
        $exp = ["notice", "Round over, Julia won!"];
        $this->assertEquals($exp, $flash);

        $this->roundOver = true;
        $this->finished = false;
        $bank = $this->createMock(Player21::class);
        $bank->method('getName')->willReturn('Bank');
        $this->winner = $bank;
        $flash = $this->generateFlash();
        $exp = ["warning", "Round over, Bank won!"];
        $this->assertEquals($exp, $flash);
    }

    public function generateFlashTest2(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn('Julia');
        $this->winner = $player;
        $this->roundOver = true;
        $this->finished = true;
        $flash = $this->generateFlash();
        $exp = ["notice", "Game over, Julia won!"];
        $this->assertEquals($exp, $flash);
    }

    public function generateFlashTest3(): void
    {
        $bank = $this->createMock(Player21::class);
        $bank->method('getName')->willReturn('Bank');
        $this->winner = $bank;
        $this->roundOver = true;
        $this->finished = true;
        $flash = $this->generateFlash();
        $exp = ["warning", "Game over, Bank won!"];
        $this->assertEquals($exp, $flash);
    }
}
