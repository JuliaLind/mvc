<?php

namespace App\ProjectEvaluator;

use PHPUnit\Framework\TestCase;

class CheckEmptyGridTraitTest extends TestCase
{
    use CheckEmptyGridTrait;

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * "mock-metod" to remove dependecy
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    private function handRuleWith(array $hands, int $index, array $deck, string $card)
    {
        return [
            'points' => 47,
            'rule' => "TestRule"
        ];
    }

    public function testAddCard(): void
    {
        $exp = [
            'col-rule' => "TestRule",
            'row-rule' => "TestRule",
            'slot' => [0, 0],
            'row-rules-with-card' => ["TestRule", "", "", "", ""],
            'row-rules-without-card' => ["", "", "", "", ""],
            'col-rules-with-card' => ["TestRule", "" ,"", "", ""],
            'col-rules-without-card' => ["", "" ,"", "", ""]
        ];
        $res = $this->emptyGridSuggestion([], "card");
        $this->assertEquals($exp, $res);
    }

}
