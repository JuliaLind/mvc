<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait5Test extends TestCase
{
    use FullHouseTrait5;


    public function testCheckBothOk(): void
    {
        $res = $this->checkBoth(true, true);
        $this->assertTrue($res);
    }

    public function testCheckBothNotOk(): void
    {
        $res = $this->checkBoth(false, true);
        $this->assertFalse($res);
    }

    public function testCheckBothNotOk2(): void
    {
        $res = $this->checkBoth(true, false);
        $this->assertFalse($res);
    }

    public function testCheckBothNotOk3(): void
    {
        $res = $this->checkBoth(false, false);
        $this->assertFalse($res);
    }
}
