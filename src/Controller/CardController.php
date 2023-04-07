<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCardsExt;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        $data = [
            'page' => "card-landing",
            'url' => "/card",
        ];
        return $this->render('card/home.html.twig', $data);
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(): Response
    {
        $data = [
            'page' => "card-deck",
            'url' => "/card",
        ];
        return $this->render('card/cards.html.twig', $data);
    }

    #[Route("/card/deck/draw/{number<\d+>}", name: "draw_many")]
    public function drawCards(int $number): Response
    {
        $deck = new DeckOfCardsExt();
        if ($number > $deck->cardsLeft()) {
            throw new \Exception(`Can not draw more than {$deck->cardsLeft()} cards!`);
        }

        $hand = new cardHand();

        for ($i = 1; $i <= $number; $i++) {
            $hand->add();
            $die->roll();
            $diceRoll[] = $die->getAsString();
        }

        $data = [
            "num_dices" => count($diceRoll),
            "diceRoll" => $diceRoll,
            'page' => "dice-roll",
            'url' => `/game/pig/test/roll/{$num}`,
        ];

        return $this->render('pig/test/roll_many.html.twig', $data);
    }

    #[Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")]
    public function testDiceHand(int $num): Response
    {
        if ($num > 99) {
            throw new \Exception("Can not roll more than 99 dices!");
        }

        $hand = new DiceHand();
        for ($i = 1; $i <= $num; $i++) {
            if ($i % 2 === 1) {
                $hand->add(new DiceGraphic());
            } else {
                $hand->add(new Dice());
            }
        }

        $hand->roll();

        $data = [
            "num_dices" => $hand->getNumberDices(),
            "diceRoll" => $hand->getString(),
            'page' => "dice-hand",
            'url' => `/game/pig/test/dicehand/{$num}`,
        ];

        return $this->render('pig/test/dicehand.html.twig', $data);
    }

    #[Route("/game/pig/init", name: "pig_init_get", methods: ['GET'])]
    public function init(): Response
    {
        $data = [
            'page' => "initiate game",
            'url' => `/game/pig/init`,
        ];
        return $this->render('pig/init.html.twig', $data);
    }

    #[Route("/game/pig/init", name: "pig_init_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response {
        $numDice = $request->request->get('num_dices');

        $hand = new DiceHand();
        for ($i = 1; $i <= $numDice; $i++) {
            $hand->add(new DiceGraphic());
        }
        $hand->roll();

        $session->set("pig_dicehand", $hand);
        $session->set("pig_dices", $numDice);
        $session->set("pig_round", 0);
        $session->set("pig_total", 0);

        return $this->redirectToRoute('pig_play');
    }

    #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        $dicehand = $session->get("pig_dicehand");

        $data = [
            "pigDices" => $session->get("pig_dices"),
            "pigRound" => $session->get("pig_round"),
            "pigTotal" => $session->get("pig_total"),
            "diceValues" => $dicehand->getString(),
            'page' => "play",
            'url' => `/game/pig/play`,
        ];

        return $this->render('pig/play.html.twig', $data);
    }

    #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    public function roll(
        SessionInterface $session
    ): Response {

        $hand = $session->get("pig_dicehand");
        $hand->roll();

        $roundTotal = $session->get("pig_round");
        $round = 0;
        $values = $hand->getValues();
        foreach ($values as $value) {
            if ($value === 1) {
                $round = 0;
                $roundTotal = 0;
                break;
            }
            $round += $value;
        }

        $session->set("pig_round", $roundTotal + $round);

        return $this->redirectToRoute('pig_play');
    }

    #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    public function save(
        SessionInterface $session
    ): Response {
        $roundTotal = $session->get("pig_round");
        $gameTotal = $session->get("pig_total");

        $session->set("pig_round", 0);
        $session->set("pig_total", $roundTotal + $gameTotal);

        return $this->redirectToRoute('pig_play');
    }

    // #[Route("/game/pig/test/roll", name: "test_roll_dice")]
    // public function testRollDice(): Response
    // {
    //     $die = new Dice();

    //     $data = [
    //         "dice" => $die->roll(),
    //         "diceString" => $die->getAsString(),
    //         'page' => "roll",
    //     ];

    //     return $this->render('pig/test/roll.html.twig', $data);
    // }
}
