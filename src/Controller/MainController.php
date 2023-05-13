<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

use App\Helpers\MainControllerHelper;

use App\Markdown\MdParser;

/**
 * The main controller class
 */
class MainController extends AbstractController
{
    /**
     * Home route
     */
    #[Route("/", name: "home")]
    public function home(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {
        $data = $helper->homeData();
        return $this->render('home.html.twig', $data);
    }

    /**
     * Route that contains information about the course MVC
     */
    #[Route("/about", name: "about")]
    public function about(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {
        $data = $helper->aboutData();
        return $this->render('about.html.twig', $data);
    }

    /**
     * Report route, contains reports of each kmom
     */
    #[Route("/report", name: "report")]
    public function report(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {
        $data = $helper->reportData();

        return $this->render('report.html.twig', $data);
    }

    /**
     * Route displays a forest with monkey where
     * the monkeys location in the forest randomly changes
     * each time page is loaded/re-loaded
     */
    #[Route("/lucky", name: "lucky")]
    public function number(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {

        $data = $helper->luckyData();

        return $this->render('lucky.html.twig', $data);
    }
}
