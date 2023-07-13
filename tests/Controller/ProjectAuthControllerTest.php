<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use App\Entity\User;
use App\Entity\Transaction;
use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectAuthControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testRegisterOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $client->getContainer()
        ->get('doctrine');

        /**
         * @var UserRepository $repo
         */
        $repo = $doctrine->getRepository(User::class);

        $client->request(
            'POST',
            '/proj/register',
            [
            'email' => 'new-user@test.se',
            'acronym' => 'New User',
            'password' => 'newuser',
            'password2' => 'newuser'
        ]
        );


        $this->assertResponseRedirects('/proj');
        $this->assertRouteSame('register');

        $userId = $session->get('user');
        $this->assertEquals(4, $userId);
        /**
         * @var User $user
         */
        $user = $repo->find(4);
        /**
         * @var TransactionRepository $transRepo
         */
        $transRepo = $doctrine->getRepository(Transaction::class);
        /**
         * @var Transaction $transaction
         */
        $transaction = $transRepo->findOneBy(['user' => $user]);

        $this->assertEquals('new-user@test.se', $user->getEmail());
        $this->assertEquals(1000, $transaction->getAmount());
    }

    public function testRegisterNotOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $client->getContainer()
        ->get('doctrine');

        /**
         * @var UserRepository $repo
         */
        $repo = $doctrine->getRepository(User::class);

        $client->request(
            'POST',
            '/proj/register',
            [
                'email' => 'new-user@test.se',
                'acronym' => 'New User',
                'password' => 'newuser',
                'password2' => 'notsamepassword'
            ]
        );

        $expectedFlashbag = ['warning' => ["Passwords did not match"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
        $this->assertResponseRedirects('/proj/register-form');
        $this->assertRouteSame('register');

        $userId = $session->get('user');
        $this->assertNull($userId);

        $user = $repo->find(4);
        $this->assertNull($user);
    }

    public function testRegisterNotOk2(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $client->getContainer()
        ->get('doctrine');

        /**
         * @var UserRepository $repo
         */
        $repo = $doctrine->getRepository(User::class);
        $client->request(
            'POST',
            '/proj/register',
            [
                'email' => 'user0@test.se',
                'acronym' => 'New User',
                'password' => 'newuser',
                'password2' => 'newuser'
            ]
        );

        $expectedFlashbag = ['warning' => ["A user with this email or Gamer name already exists"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
        $this->assertResponseRedirects('/proj/register-form');
        $this->assertRouteSame('register');

        $userId = $session->get('user');
        $this->assertNull($userId);

        $user = $repo->find(4);
        $this->assertNull($user);
    }

    public function testLoginOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request(
            'POST',
            '/proj/login',
            [
            'email' => 'user0@test.se',
            'password' => 'julia'
        ]
        );


        $this->assertResponseRedirects('/proj');
        $this->assertRouteSame('login');

        $userId = $session->get('user');
        $this->assertEquals(1, $userId);
    }

    public function testLoginNotOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request(
            'POST',
            '/proj/login',
            [
            'email' => 'user0@test.se',
            'password' => 'wrongpassword'
        ]
        );

        $expectedFlashbag = ['warning' => ["The password you entered does not match the email"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
        $this->assertResponseRedirects('/proj');
        $this->assertRouteSame('login');

        $userId = $session->get('user');
        $this->assertNull($userId);
    }

    public function testLoginNotOk2(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request(
            'POST',
            '/proj/login',
            [
            'email' => 'user77@test.se',
            'password' => 'wrongpassword'
        ]
        );

        $expectedFlashbag = ['warning' => ["There is no user with this email"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
        $this->assertResponseRedirects('/proj');
        $this->assertRouteSame('login');

        $userId = $session->get('user');
        $this->assertNull($userId);
    }

    public function testLogout(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request(
            'POST',
            '/proj/login',
            [
            'email' => 'user0@test.se',
            'password' => 'julia'
        ]
        );


        $this->assertResponseRedirects('/proj');
        $this->assertRouteSame('login');

        $userId = $session->get('user');
        $this->assertEquals(1, $userId);

        $client->request('GET', '/proj/logout');
        $this->assertRouteSame('logout');
        $this->assertResponseRedirects('/proj');
        $client->request('GET', '/proj');
        $this->assertSelectorTextContains('h2', 'Login to play');
    }
}
