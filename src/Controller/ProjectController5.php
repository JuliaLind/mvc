<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Repository\TransactionRepository;
use App\Project\Game;
use App\Project\Register;

/**
 * The main controller class
 */
class ProjectController5 extends AbstractController
{
    #[Route("/proj/api", name: "proj-api")]
    public function projApiLanding(): Response
    {
        $data = [
            'url' => "api"
        ];
        return $this->render('proj/api.html.twig', $data);
    }

    #[Route("/proj/about", name: "proj-about")]
    public function projAbout(): Response
    {
        $data = [
            'url' => "about"
        ];
        return $this->render('proj/api.html.twig', $data);
    }

    #[Route("/proj/rules", name: "proj-rules")]
    public function projRules(): Response
    {
        $data = [
            'url' => "rules"
        ];
        return $this->render('proj/rules.html.twig', $data);
    }

    #[Route("/proj/register-form", name: "register-form")]
    public function projRegisterForm(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/register-form.html.twig', $data);
    }
}