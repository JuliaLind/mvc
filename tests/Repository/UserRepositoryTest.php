<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Exception;

class UserRepositoryTest extends KernelTestCase
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
         * @var UserRepository $userRepository
         */
        $userRepository = $this->entityManager
        ->getRepository(User::class);

        /**
         * @var User $user
         */
        $user= new User();

        $email = 'user@bth.se';
        $acronym = 'User1';
        $password = 'user1';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user->setEmail($email);
        $user->setAcronym($acronym);
        $user->setHash($hash);
        $userRepository->save($user, true);


        /**
         * @var User $user
         */
        $user = $userRepository->findOneBy(['email' => $email]);

        $this->assertEquals(4, $user->getId());
    }

    public function testRemove(): void
    {
        /**
         * @var UserRepository $userRepository
         */
        $userRepository = $this->entityManager
        ->getRepository(User::class);

        /**
         * @var User $user
         */
        $user = $userRepository->findOneBy(['email' => 'doe@bth.se']);
        $this->assertSame('John Doe', $user->getAcronym());

        $userRepository->remove($user, true);

        $res = $userRepository->findOneBy(['email' => 'doe@bth.se']);
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
