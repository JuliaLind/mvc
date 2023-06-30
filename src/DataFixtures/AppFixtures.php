<?php

namespace App\DataFixtures;

use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Score;
use App\Entity\Transaction;
use App\Entity\User;
use Datetime;

#[CodeCoverageIgnore]
class AppFixtures extends Fixture
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength )
     */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $julia = new User();
        $julia->setEmail("julia@bth.se");
        $julia->setAcronym("Julia");
        $hash = password_hash("julia", PASSWORD_DEFAULT);
        $julia->setHash($hash);
        $manager->persist($julia);

        $doe = new User();
        $doe->setEmail("doe@bth.se");
        $doe->setAcronym("John Doe");
        $hash = password_hash("doe", PASSWORD_DEFAULT);
        $doe->setHash($hash);
        $manager->persist($doe);

        $jane = new User();
        $jane->setEmail("jane@bth.se");
        $jane->setAcronym("Jane Doe");
        $hash = password_hash("jane", PASSWORD_DEFAULT);
        $jane->setHash($hash);
        $manager->persist($jane);

        $score5 = new Score();
        $score5->setRegistered(new DateTime('2023-06-27'));
        $score5->setPoints(43);
        $score5->setUser($doe);
        $manager->persist($score5);

        $score1 = new Score();
        $score1->setRegistered(new DateTime('2023-06-29'));
        $score1->setPoints(38);
        $score1->setUser($julia);
        $manager->persist($score1);

        $score8 = new Score();
        $score8->setRegistered(new DateTime('2023-06-30'));
        $score8->setPoints(70);
        $score8->setUser($doe);
        $manager->persist($score8);

        $score3 = new Score();
        $score3->setRegistered(new DateTime('2023-06-30'));
        $score3->setPoints(132);
        $score3->setUser($julia);
        $manager->persist($score3);

        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime('2023-06-25'));
        $transaction->setDescr('Free registration bonus');
        $transaction->setAmount(1000);
        $transaction->setUser($julia);
        $manager->persist($transaction);


        $transaction9 = new Transaction();
        $transaction9->setRegistered(new DateTime('2023-06-27'));
        $transaction9->setDescr('Free registration bonus');
        $transaction9->setAmount(1000);
        $transaction9->setUser($jane);
        $manager->persist($transaction9);

        $transaction0 = new Transaction();
        $transaction0->setRegistered(new DateTime('2023-06-27'));
        $transaction0->setDescr('Free registration bonus');
        $transaction0->setAmount(1000);
        $transaction0->setUser($julia);
        $manager->persist($transaction0);

        $transaction5 = new Transaction();
        $transaction5->setRegistered(new DateTime('2023-06-27'));
        $transaction5->setDescr('Bet');
        $transaction5->setAmount(-40);
        $transaction5->setUser($doe);
        $manager->persist($transaction5);

        $transaction6 = new Transaction();
        $transaction6->setRegistered(new DateTime('2023-06-27'));
        $transaction6->setDescr('Return (bet x 2)');
        $transaction6->setAmount(80);
        $transaction6->setUser($doe);
        $manager->persist($transaction6);

        $transaction1 = new Transaction();
        $transaction1->setRegistered(new DateTime('2023-06-29'));
        $transaction1->setDescr('Bet');
        $transaction1->setAmount(-420);
        $transaction1->setUser($julia);
        $manager->persist($transaction1);

        $transaction2 = new Transaction();
        $transaction2->setRegistered(new DateTime('2023-06-29'));
        $transaction2->setDescr('Return (bet x 2)');
        $transaction2->setAmount(840);
        $transaction2->setUser($julia);
        $manager->persist($transaction2);

        $transaction3 = new Transaction();
        $transaction3->setRegistered(new DateTime('2023-06-30'));
        $transaction3->setDescr('Bet');
        $transaction3->setAmount(-20);
        $transaction3->setUser($julia);
        $manager->persist($transaction3);

        $transaction4 = new Transaction();
        $transaction4->setRegistered(new DateTime('2023-06-30'));
        $transaction4->setDescr('Return (bet x 2)');
        $transaction4->setAmount(40);
        $transaction4->setUser($julia);
        $manager->persist($transaction4);

        $transaction7 = new Transaction();
        $transaction7->setRegistered(new DateTime('2023-06-30'));
        $transaction7->setDescr('Bet');
        $transaction7->setAmount(-10);
        $transaction7->setUser($doe);
        $manager->persist($transaction7);

        $transaction8 = new Transaction();
        $transaction8->setRegistered(new DateTime('2023-06-30'));
        $transaction8->setDescr('Return (bet x 2)');
        $transaction8->setAmount(20);
        $transaction8->setUser($doe);
        $manager->persist($transaction8);

        $manager->flush();

    }
}
