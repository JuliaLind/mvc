<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Transaction;
use Datetime;

// use App\Project\UserAlreadyExistsException;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * The main controller class
 */
class ProjectAuthController extends AbstractController
{
    #[Route("/proj/register", name: "register", methods: ['POST'])]
    public function projRegister(
        UserRepository $userRepo,
        // TransactionRepository $transactionRepo,
        EntityManagerInterface $entityManager,
        Request $request,
        SessionInterface $session
    ): Response {
        /**
         * @var string $email
         */
        $email = $request->get('email');
        /**
         * @var string $acronym
         */
        $acronym = $request->get('acronym');
        /**
         * @var string $password
         */
        $password = $request->get('password');
        /**
         * @var string $password2
         */
        $password2 = $request->get('password2');
        if ($password != $password2) {
            $this->addFlash('warning', "Passwords did not match");
            return $this->redirectToRoute('register-form');
        }
        /**
         * @var string $hash
         */
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User();
        $user->setEmail($email);
        $user->setAcronym($acronym);
        $user->setHash($hash);
        // try {
        //     $userRepo->save($user, true);
        // } catch (UniqueConstraintViolationException) {
        //     $this->addFlash('warning', "A user with this email or Gamer name already exists");
        //     return $this->redirectToRoute('register-form');
        // }
        date_default_timezone_set('Europe/Stockholm');
        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime());
        $transaction->setDescr('Free registration bonus');
        $transaction->setAmount(1000);
        $transaction->setUserId($user);
        // $transactionRepo->save($transaction, true);
        try {
            $entityManager->persist($user);
            $entityManager->persist($transaction);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            $this->addFlash('warning', "A user with this email or Gamer name already exists");
            return $this->redirectToRoute('register-form');
        }
        $entityManager->persist($user);
        $entityManager->persist($transaction);
        $entityManager->flush();
        /**
         * @var User $user
         */
        $user = $userRepo->findOneBy(['email' => $email]);
        $session->set("user", $user);
        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/purchase/{coins<\d+>}", name: "purchase", methods: ['POST'])]
    public function projPurchase(
        int $coins,
        // UserRepository $userRepo,
        // TransactionRepository $transRepo,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    ): Response {
        /**
         * @var User $user
         */
        $user = $session->get("user");
        // apparently neccessary to get the same object again from database in order
        // for Doctrine not to mistake it to be a new one
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($user->getId());
        date_default_timezone_set('Europe/Stockholm');
        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime());
        $transaction->setDescr('Purchase');
        $transaction->setAmount($coins);

        $transaction->setUserId($user);
        $entityManager->persist($transaction);
        $entityManager->flush();
        /**
         * @var TransactionRepository $repo
         */
        $repo = $entityManager->getRepository(Transaction::class);
        $balance = $repo->getUserBalance($user);
        $this->addFlash('notice', "You have successfully purchsed {$coins} coins. Your new balance is {$balance} coins");
        return $this->redirectToRoute('shop');
    }

    #[Route("/proj/login", name: "login", methods: ['POST'])]
    public function projLogin(
        Request $request,
        SessionInterface $session,
        UserRepository $userRepo,
    ): Response {
        /**
         * @var string $email
         */
        $email = $request->get('email');
        /**
         * @var string $password
         */
        $password = $request->get('password');
        /**
         * @var User $user
         */
        $user = $userRepo->findOneBy(['email' => $email]);
        if ($user == null) {
            $this->addFlash('warning', "There is no user with this email");
            return $this->redirectToRoute('register-form');
        }
        /**
         * @var string $hash
         */
        $hash = $user->getHash();
        if (password_verify($password, $hash) === false) {
            $this->addFlash('warning', "The password you entered does not match the email");
            return $this->redirectToRoute('register-form');
        }

        $session->set("user", $user);

        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/logout", name: "logout", methods: ['GET'])]
    public function projLogout(
        SessionInterface $session
    ): Response {
        $session->clear();
        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/shop", name: "shop")]
    public function projShop(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/shop.html.twig', $data);
    }

    #[Route("/proj/select-amount", name: "select-amount")]
    public function selectAmount(
        SessionInterface $session,
        TransactionRepository $repo,
    ): Response {
        /**
         * @var User $user
         */
        $user = $session->get("user");
        $balance = $repo->getUserBalance($user);
        if ($balance < 10) {
            $this->addFlash('warning', "You do not have enough coins, the minimum amount to bet is 10 coins. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-shop');
        }
        $data = [
            'url' => "proj",
            'balance' => $balance,
        ];
        return $this->render('proj/select-amount.html.twig', $data);
    }
}
