<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\JsonConverter;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Transaction;
use App\Entity\Score;
use App\Project\Register;
use Datetime;

/**
 * Contains API routes for the project
 */
class ProjectApiController6 extends AbstractController
{
    /**
     * Shows all users registered in database (does not include transactions- and score-tables)
     */
    #[Route('/proj/api/users', name: "api-users", methods: ['GET'])]
    public function apiUsers(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $users = $entityManager->getRepository(User::class)->findAll();
        $data = [];
        foreach($users as $user) {
            /**
             * @var int $userId
             */
            $userId = $user->getId();
            $register = new Register($entityManager, $userId);
            $balance = $register->getBalance();
            $info = [
                'id' => $userId,
                'acronym' => $user->getAcronym(),
                'email' => $user->getEmail(),
                'hash' => $user->getHash(),
                'balance' => $balance
            ];
            $data[] = $info;
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
