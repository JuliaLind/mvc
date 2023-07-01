<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Project\RegisterFactory;
use App\Project\Game;
use App\ProjectGrid\Grid;

class ProjectController11 extends AbstractController
{
    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game") ?? null;
        if ($game == null) {
            return $this->redirectToRoute('proj');
        }
        $state = $game->currentState();
        $data = [
            ...$state,
            'url' => "",
        ];

        if ($state['finished'] === true) {
            $this->addFlash('notice', $data['message']);
            return $this->render('proj/results.html.twig', $data);
        }

        if (count($state['fromSlot']) > 0) {
            $this->addFlash('notice', "Click on an empty slot to which you want to move the selected card");
            return $this->render('proj/place-card.html.twig', $data);
        }

        if ($session->get("show-suggestion")) {
            /**
             * @var array<string,mixed> $suggestion
             */
            $suggestion = $data['suggestion'];
            /**
             * @var string $message
             */
            $message = $suggestion['message'];
            $this->addFlash('notice', $message);
            return $this->render('proj/game-display-suggest.html.twig', $data);
        }
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = $factory->create($entityManager, $userId);
        $data['balance'] = $register->getBalance();
        return $this->render('proj/game.html.twig', $data);
    }
}
