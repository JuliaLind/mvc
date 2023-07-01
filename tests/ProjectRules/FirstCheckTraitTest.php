<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FirstCheckTraitTest extends TestCase
{
    use FirstCheckTrait;

    /**
     * @var array<string> $arg1
     */
    private array $arg1 = [];
    /**
     * @var array<string> $arg2
     */
    private array $arg2 = [];

    /**
     * "mock-metod" to remove dependecy
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function check2(array $hand, array $deck): bool
    {
        $this->arg1 = $hand;
        $this->arg2 = $deck;
        return true;
    }

    public function testCheck(): void
    {
        $hand = ["14C", "8D", "5H"];
        $card = "3S";
        $deck = ["8S", "2S", "4H", "7H"];
        $res = $this->check($hand, $deck, $card);
        $this->assertTrue($res);

        $this->assertEquals([...$hand, $card], $this->arg1);
        $this->assertEquals($deck, $this->arg2);
    }

}
