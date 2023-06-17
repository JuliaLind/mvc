<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * The main controller class
 */
class ProjectAuthController extends AbstractController
{
    #[Route("/proj/register", name: "register", methods: ['POST'])]
    public function projRegister(
        Request $request,
        SessionInterface $session
    ): Response {
        $username = $request->get('username');
        $password = $request->get('password');
        $password2 = $request->get('password2');
        if ($password != $password2) {
            return $this->redirectToRoute('login-form');
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // register username and password hash to database
        // get user from db by username and save user to session
        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/login", name: "login", methods: ['POST'])]
    public function projLogin(
        Request $request,
        SessionInterface $session
    ): Response {
        // get user from db by username
        // $success = password_verify($password, $hash);
        // if ok save user to session
        return $this->redirectToRoute('proj');
    }

    #[Route("/proj/logout", name: "logout", methods: ['GET'])]
    public function projLogout(
        Request $request,
        SessionInterface $session
    ): Response {
        $session->clear();
        return $this->redirectToRoute('proj');
    }
}
