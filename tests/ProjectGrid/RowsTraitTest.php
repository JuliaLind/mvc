<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class RowsTraitTest extends TestCase
{
    use RowsTrait;

    public function testGetRows(): void
    {
        $this->grid = [
            1 => [1 => "7C"],
            3 => [2 => "12C", 3 => "6C"],
            4 => [2 => "5C"]
        ];
        $this->assertSame($this->grid, $this->getRows());
    }
}
