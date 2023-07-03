<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait6Test extends TestCase
{
    use FullHouseTrait6;


    public function testCheckThreeOk(): void
    {
        $res = $this->checkThree(false, 3);
        $this->assertTrue($res);
    }

    public function testCheckThreeOk2(): void
    {
        $res = $this->checkThree(false, 4);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $res = $this->checkThree(true, 3);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $res = $this->checkThree(false, 2);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $res = $this->checkThree(true, 2);
        $this->assertFalse($res);
    }

}
