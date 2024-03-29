<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Doctrine\DBAL\Connection;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ProjectResetControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that the reset route is working
     */
    public function testReset(): void
    {
        $loader = $this->createMock(SqlFileLoader::class);
        $connection = $this->createMock(Connection::class);

        $loader->expects($this->once())
        ->method('load')
        ->with($this->equalTo('sql/reset-proj.sql'));
        $client = static::createClient([
            'services' => [
                'connection' => $connection
            ]
        ]);
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(SqlFileLoader::class, $loader);
        $container->set(Session::class, $session);


        $client->request('POST', '/proj/reset');
        $this->assertRouteSame('reset_project');
        $this->assertResponseRedirects('/proj/about/database');
        $expectedFlashbag = ['notice' => ["Databastabellerna relaterade till projektet är återställda"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }
}
