<?php

namespace App\Repository;

use App\Entity\Score;
use App\Entity\User;

use Datetime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ScoreRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        /** @phpstan-ignore-next-line */
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSave(): void
    {
        /**
         * @var User $user
         */
        $user = $this->entityManager
        ->getRepository(User::class)->find(1);

        $score = new Score();
        $score->setUser($user);
        $date = new DateTime('2023-07-06');
        $score->setRegistered($date);
        $score->setPoints(123456789);
        /**
         * @var ScoreRepository $repo
         */
        $repo = $this->entityManager->getRepository(Score::class);
        $repo->save($score, true);

        /**
         * @var Score $score
         */
        $score = $repo->findOneBy(["points" => 123456789]);

        $this->assertSame($user, $score->getUser());
        $this->assertSame(5, $score->getId());
    }

    public function testRemove(): void
    {

        /**
         * @var ScoreRepository $repo
         */
        $repo = $this->entityManager->getRepository(Score::class);
        /**
                 * @var Score $score
                 */
        $score = $repo->find(2);
        $this->assertEquals(38, $score->getPoints());

        $repo->remove($score, true);

        $res = $repo->find(2);
        $this->assertNull($res);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        /** @phpstan-ignore-next-line */
        $this->entityManager = null;
    }
}
