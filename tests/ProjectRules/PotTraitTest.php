<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class PotTraitTest extends TestCase
{
    use PotTrait;

    public function testGetAdditionalValue(): void
    {
        $this->assertEquals(0, $this->pot);

        $this->setPot(80);

        $this->assertEquals(80, $this->pot);
    }
}
