<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use App\Markdown\MdParser;

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
        $data = $helper->standardData('home');
        return $this->render('standard.html.twig', $data);
    }

    /**
     * Route that contains information about the course MVC
     */
    #[Route("/about", name: "about")]
    public function about(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {
        $data = $helper->standardData('about');
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
        LuckyMonkey $monkey=new LuckyMonkey()
    ): Response {
        $data = $monkey->data();
        return $this->render('lucky.html.twig', $data);
    }

    /**
     * Route displays a forest with monkey where
     * the monkeys location in the forest randomly changes
     * each time page is loaded/re-loaded
     */
    #[Route("/metrics", name: "metrics")]
    public function metrics(
        MainControllerHelper $helper=new MainControllerHelper()
    ): Response {
        $data = $helper->standardData('metrics');
        return $this->render('standard.html.twig', $data);
    }
}
