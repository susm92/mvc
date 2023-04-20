<?php

namespace App\Controller;

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
        $session->set('deck', new GraphicDeckOfCards());


        $session->set('player_hand', new CardHand());
        $session->set('player_points', 0);
        
        $session->set('bank_hand', new CardHand());
        $session->set('bank_points', 0);

        return $this->redirectToRoute('play_get');
    }

    ###########################################################
    ######################### SPELARE #########################
    ###########################################################

    #[Route('game/play', name: 'play_get', methods: ['GET'])]
    public function getGame(
        SessionInterface $session
    ): Response
    {
        $p_deck = $session->get('deck');
        $hand = $session->get('player_hand');
        $points = $session->get('player_points');

        if ($session->get('player_drawn') == true)
        {
            $addPoints = $p_deck->points();

            if ($addPoints == 'ace' && $points < 10) {
                $points += 11;
            } elseif ($addPoints == 'ace' && $points >= 10) {
                $points += 1;
            } else {
                $points += $addPoints;
            }
        }

        $data = [
            'cardhand' => $hand->showCards(),
            'amount' => $p_deck->getAmount(),
            'points' => $points,
        ];

        $session->set('player_points', $points);
        $session->set('player_drawn', false);

        return $this->render('game/play.html.twig', $data);
    }

    #[Route('game/draw', name: 'game_draw', methods: ['POST'])]
    public function drawCard(
        SessionInterface $session
    ): Response
    {
        $hand = $session->get('player_hand');
        $hand->addCards($session->get('deck'), 1);

        $session->set('player_hand', $hand);

        $session->set('player_drawn', true);

        return $this->redirectToRoute('play_get');
    }

    ###########################################################
    ######################### BANK ############################
    ###########################################################

    #[Route('game/handover', name: 'hold', methods: ['GET'])]
    public function handOver(): Response
    {
        return $this->redirectToRoute('bank_plays');
    }

    #[Route('game/bank_plays', name: 'bank_plays')]
    public function bankPlays(
        SessionInterface $session
    ): Response
    {
        $b_deck = $session->get('deck'); 
        $b_hand = $session->get('bank_hand');
        $points = $session->get('bank_points');

        while ($points < 18)
        {
            $b_hand->addCards($b_deck, 1);
            $addPoints = $b_deck->points();
            
            if ($addPoints == 'ace' && $points < 10) {
                $points += 11;
            } elseif ($addPoints == 'ace' && $points >= 10) {
                $points += 1;
            } else {
                $points += $addPoints;
            }
        }

        $session->set('bank_points', $points);
        $session->set('bank_hand', $b_hand);
        
        return $this->redirectToRoute('score');
    }

    #[Route('game/score', name: 'score')]
    public function Score(
        SessionInterface $session
    ): Response
    {
        $data = [
            'p_hand' => $session->get('player_hand')->showCards(),
            'p_points' => $session->get('player_points'),
            'b_hand' => $session->get('bank_hand')->showCards(),
            'b_points' => $session->get('bank_points'),
        ];

        return $this->render('game/score.html.twig', $data);
    }
}
