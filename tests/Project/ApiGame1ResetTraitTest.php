<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use PHPUnit\Framework\TestCase;

class ApiGame1ResetTraitTest extends TestCase
{
    use ApiGame1ResetTrait;

    public function testReset(): void
    {
        $grid = $this->createMock(Grid::class);
        $deck = $this->createMock(Deck::class);
        $this->reset($grid, $deck);

        $this->assertSame($grid, $this->grid);
        $this->assertSame($deck, $this->deck);
    }
}
