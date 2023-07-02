<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Project\RegisterFactory;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * Controller related to the Project. Contains
 * routes for handling user registration, login and logout
 */
class ProjectAuthController extends AbstractController
{
    #[Route("/proj/register", name: "register", methods: ['POST'])]
    public function projRegister(
        EntityManagerInterface $entityManager,
        Request $request,
        SessionInterface $session,
        RegisterFactory $factory = new RegisterFactory()
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

        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            $this->addFlash('warning', "A user with this email or Gamer name already exists");
            return $this->redirectToRoute('register-form');
        }

        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        /**
         * @var int userId
         */
        $userId = $user->getId();

        $register = $factory->create($entityManager, $userId);
        $register->transaction(1000, 'Free registration bonus');

        $session->set("user", $userId);
        return $this->redirectToRoute('proj');
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

        $session->set("user", $user->getId());

        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/logout", name: "logout", methods: ['GET'])]
    public function projLogout(
        SessionInterface $session
    ): Response {

        // ändra denna till unset sen!
        $session->clear();
        return $this->redirectToRoute('proj');
    }
}
