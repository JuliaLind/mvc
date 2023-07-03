<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class AdditionalValueTraitTest extends TestCase
{
    use AdditionalValueTrait;

    public function testGetAdditionalValue(): void
    {
        $this->assertEquals(0, $this->getAdditionalValue());

        $this->additionalValue = 3;
        $this->assertEquals(3, $this->getAdditionalValue());
    }
}
