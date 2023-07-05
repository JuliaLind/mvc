<?php

namespace App\Project;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;

class RegisterFactoryTest extends KernelTestCase
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


    public function testcreate(): void
    {
        $factory = new RegisterFactory();
        $register = $factory->create($this->entityManager, 1);
        $this->assertInstanceOf("\App\Project\Register", $register);

    }
}
