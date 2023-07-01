<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait2Test extends TestCase
{
    use TwoPairsTrait2;

    /**
     * @var array<string> $arg
     */
    private array $arg = [];

    /**
     * "mock-metod" to remove dependecy
     * @param array<string> $cards
     */
    public function check3(array $cards): bool
    {
        $this->arg = $cards;
        return true;
    }

    public function testCheck(): void
    {
        $hand = ["14C", "8D", "5H"];
        $res = $this->check($hand);
        $this->assertTrue($res);

        $this->assertEquals($hand, $this->arg);
    }

}
