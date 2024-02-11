<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Datetime;
use App\Project\UserNotRegisteredException;

/**
 * Test cases for class Book.
 */
class UserTest extends TestCase
{
    /**
     * Construct object and check that all setters and getters
     * work as expected
     */
    public function testCreateObject(): void
    {
        $date = new DateTime('2023-06-30');
        $amount = -40;
        $descr = 'Bet';
        $user = new User();

        $email = 'user@bth.se';
        $acronym = 'User1';
        $password = 'user1';
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user->setEmail($email);
        $user->setAcronym($acronym);
        $user->setHash($hash);

        $transaction = new Transaction();
        $transaction->setRegistered($date);
        $transaction->setAmount($amount);
        $transaction->setDescr($descr);
        $transaction->setUser($user);


        $res = $user->getEmail();
        $exp = $email;
        $this->assertEquals($exp, $res);

        $res = $user->getAcronym();
        $exp = $acronym;
        $this->assertEquals($exp, $res);

        /**
         * @var string $storedHash
         */
        $storedHash = $user->getHash();
        $this->assertTrue(password_verify($password, $storedHash));

        $this->expectException(UserNotRegisteredException::class);
        $res = $user->getId();
        $this->assertNull($res);

        // $transactions = $user->getTransactions()->toArray();
        // $this->assertEquals([$transaction], $transactions);
    }
}
