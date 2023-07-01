<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushStatTrait2Test extends TestCase
{
    use FlushStatTrait2;

    private bool $checkInDeck = false;
    private bool $setSuit = false;
    /**
     * @var array<string> $arg1
     */
    private array $arg1 = [];
    /**
     * @var array<string> $arg2
     */
    private array $arg2 = [];
    /**
     * @var array<string> $arg3
     */
    private array $arg3 = [];

    /**
     * "mocked" method to remove dependency
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @param array<string> $deck
     * @param array<string> $hand
     */
    private function checkInDeck(array $deck, array $hand): bool
    {
        $this->arg1 = $deck;
        $this->arg2 = $hand;
        return $this->checkInDeck;
    }

    /**
     * "mocked" method to remove dependency
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @param array<string> $hand
     */
    private function setSuit(array $hand): bool
    {
        $this->arg3 = $hand;
        return $this->setSuit;
    }

    public function testCheck2(): void
    {
        $hand = ["14C", "8D", "5H"];
        $deck = ["8S", "2S", "4H", "7H"];

        $res = $this->check2($hand, $deck);
        $this->assertFalse($res);

        $this->assertEquals([], $this->arg1);
        $this->assertEquals([], $this->arg2);
        $this->assertEquals($hand, $this->arg3);

        $this->checkInDeck = true;
        $res = $this->check2($hand, $deck);
        $this->assertFalse($res);

        $this->setSuit = true;
        $res = $this->check2($hand, $deck);
        $this->assertTrue($res);
        $this->assertEquals($deck, $this->arg1);
        $this->assertEquals($hand, $this->arg2);

        $this->checkInDeck = false;
        $res = $this->check2($hand, $deck);
        $this->assertFalse($res);
    }

}
