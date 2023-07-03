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

    private bool $returnVal = false;

    /**
     * "mock-metod" to remove dependecy
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        $this->arg1 = $hand;
        $this->arg2 = $deck;
        return $this->returnVal;
    }

    public function testPossibleWithCardOk(): void
    {
        $hand = ["card1", "card2", "card3"];
        $card = "card4";
        $deck = ["card5", "card6", "card7", "card8"];
        $this->returnVal = true;
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(3, $this->additionalValue);

        $this->assertEquals([...$hand, $card], $this->arg1);
        $this->assertEquals($deck, $this->arg2);
    }

    public function testPossibleWithCardNotOk(): void
    {
        $hand = ["card1", "card2", "card3"];
        $card = "card4";
        $deck = ["card5", "card6", "card7", "card8"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
        $this->assertEquals(0, $this->additionalValue);

        $this->assertEquals([...$hand, $card], $this->arg1);
        $this->assertEquals($deck, $this->arg2);
    }

}
