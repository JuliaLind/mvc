<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $flush = new Flush();
        $hand = ["14H", "8D", "4C", "10S", "5C"];
        $res = $flush->check($hand);
        $this->assertFalse($res);

        $hand = ["14H", "8H", "4H", "10S", "5H"];
        $res = $flush->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckOk(): void
    {
        $flush = new Flush();
        $hand = ["14H", "8H", "4H", "10H", "5H"];
        $res = $flush->check($hand);
        $this->assertTrue($res);
    }
}
