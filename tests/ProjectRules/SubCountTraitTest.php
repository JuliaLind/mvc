<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SubCountTraitTest extends TestCase
{
    use SubCountTrait;

    public function testSubCountRanks(): void
    {
        $arr = [4 => 2, 5 => 1, 8 => 2, 10 => 3];
        $exp = [4 => 2, 5 => 1, 8 => 3, 10 => 3,];
        $arr = $this->subCount(8, $arr);
        $this->assertEquals($exp, $arr);

        $exp = [4 => 2, 5 => 1, 7 => 1, 8 => 3, 10 => 3];
        $arr = $this->subCount(7, $arr);
        $this->assertEquals($exp, $arr);
    }

    public function testSubCountSuits(): void
    {
        $arr = ["D" => 2, "H" => 1];
        $exp = ["D" => 2, "H" => 1, "S" => 1];
        $arr = $this->subCount("S", $arr);
        $this->assertEquals($exp, $arr);

        $exp = ["D" => 2, "H" => 1, "S" => 2];
        $arr = $this->subCount("S", $arr);
        $this->assertEquals($exp, $arr);
    }

}
