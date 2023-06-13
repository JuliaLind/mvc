<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The main controller class
 */
class ProjectFormController extends AbstractController
{
    #[Route("/proj/register-form", name: "register-form")]
    public function projRegisterForm(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/register-form.html.twig', $data);
    }
}
