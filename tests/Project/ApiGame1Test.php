<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

use PHPUnit\Framework\TestCase;

class ApiGame1Test extends TestCase
{
    public function testCreateObject(): void
    {
        $game = new ApiGame1();
        $this->assertInstanceOf("\App\Project\ApiGame1", $game);
    }
}
