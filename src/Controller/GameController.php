<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\CardGraphic;
use App\Deck\CardHand;
use App\Deck\GraphicDeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('game', name: 'game')]
    public function gHome(): Response
    {
        return $this->render('game/home.html.twig');
    }

    #[Route('game/doc', name: 'doc')]
    public function doc(): Response
    {
        return $this->render('game/doc.html.twig');
    }

    ### Själva spelet! ###
    
    #[Route('game/init', name: 'init')]
    public function start(): Response
    {
        return $this->render('game/init.html.twig');
    }

    #[Route('game/play', name: 'play_post', methods: ['POST'])]
    public function postGame(
        SessionInterface $session
    ): Response
    {
        $session->set('card', new GraphicDeckOfCards());
        $session->set('cardhand', new CardHand());
        $session->set('player_points', 0);

        return $this->redirectToRoute('play_get');
    }

    #[Route('game/play', name: 'play_get', methods: ['GET'])]
    public function getGame(
        SessionInterface $session
    ): Response
    {
        $hand = $session->get("cardhand");
        $card = $session->get('card');
        $points = $session->get('player_points');

        if ($card->points() == 'ace' && $points < 10) {
            $points += 10;
        } elseif ($card->points() == 'ace' && $points > 10) {
            $points += 1;
        } else {
            $points += $card->points();
        }

        $data = [
            'cardhand' => $hand->showCards(),
            'amount' => $card->getAmount(),
            'points' => $points,
        ];

        $points = $session->set('player_points', $points);

        return $this->render('game/play.html.twig', $data);
    }

    #[Route('game/draw', name: 'game_draw')]
    public function drawCard(
        SessionInterface $session
    ): Response
    {
        $hand = $session->get("cardhand");
        $hand->addCards($session->get('card'), 1);

        $session->set('cardhand', $hand);

        return $this->redirectToRoute('play_get');
    }
}
