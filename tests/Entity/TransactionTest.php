<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Datetime;

/**
 * Test cases for class Book.
 */
class TransactionTest extends TestCase
{
    /**
     * Construct object and check that all setters and getters
     * work as expected
     */
    public function testCreateObject(): void
    {
        $transaction = new Transaction();
        $this->assertInstanceOf("\App\Entity\Transaction", $transaction);

        $date = new DateTime('2023-06-30');
        $amount = -40;
        $descr = 'Bet';
        $user = $this->createMock(User::class);
        $transaction->setRegistered($date);
        $transaction->setAmount($amount);
        $transaction->setDescr($descr);
        $transaction->setUser($user);

        $res = $transaction->getRegistered();
        $exp = $date;
        $this->assertEquals($exp, $res);

        $res = $transaction->getAmount();
        $exp = $amount;
        $this->assertEquals($exp, $res);

        $res = $transaction->getDescr();
        $exp = $descr;
        $this->assertEquals($exp, $res);

        $res = $transaction->getUser();
        $exp = $user;
        $this->assertSame($exp, $res);


        $res = $transaction->getId();
        $this->assertNull($res);
    }
}
