<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

use App\Project\Game;
use App\Project\Register;

/**
 * Controller related to the Project. Contains the route
 * for the project landing page
 */
class ProjectLandingController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function projLanding(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        $data = [
            'url' => "proj",
        ];
        if($userId == null) {
            return $this->render('proj/index.html.twig', $data);
        }
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($userId);
        /**
         * @var Game|null $game
         */
        $game = $session->get("game") ?? null;


        $register = new Register($entityManager, $userId);

        $data = [
            ...$data,
            'user' => $user,
            'finished' => true,
            'balance' => $register->getBalance()
        ];
        if ($game) {
            $data['finished'] = $game->currentState()['finished'];
        }
        return $this->render('proj/profile.html.twig', $data);
    }
}
