<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Datetime;

/**
 * Test cases for class Book.
 */
class ScoreTest extends TestCase
{
    /**
     * Construct object and check that all setters and getters
     * work as expected
     */
    public function testCreateObject(): void
    {
        $score = new Score();
        $this->assertInstanceOf("\App\Entity\Score", $score);

        $date= new DateTime('2023-06-30');
        $points = 49;
        $user = $this->createMock(User::class);
        $score->setRegistered($date);
        $score->setPoints($points);
        $score->setUser($user);

        $res = $score->getRegistered();
        $exp = $date;
        $this->assertEquals($exp, $res);

        $res = $score->getPoints();
        $exp = $points;
        $this->assertEquals($exp, $res);

        $res = $score->getUser();
        $exp = $user;
        $this->assertSame($exp, $res);


        $res = $score->getId();
        $this->assertNull($res);
    }
}
