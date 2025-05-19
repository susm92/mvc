<?php

namespace App\Controller;

use App\Deck\CardHand;
use App\Deck\GraphicDeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    ################################################
    ################### Hemsidan ###################
    ################################################

    #[Route('/proj', name: 'project')]
    public function pHome(): Response
    {
        return $this->render('proj/sites/index.html.twig');
    }

    #[Route('/proj/about', name: 'projAbout')]
    public function pAbout(): Response
    {
        return $this->render('proj/sites/about.html.twig');
    }

    #[Route('/proj/doc', name: 'projDoc')]
    public function pDoc(): Response
    {
        return $this->render('proj/sites/doc.html.twig');
    }

    #[Route('proj/restart', name: 'projGame_restart', methods: ['POST'])]
    public function restart(
        SessionInterface $session
    ): Response {
        $session->clear();
        return $this->redirectToRoute('projGame_get');
    }

    ################################################
    ###################   SPEL   ###################
    ################################################

    #[Route('proj/init', name: 'projGame_get', methods: ['GET'])]
    public function start(): Response
    {
        return $this->render('proj/sites/init.html.twig');
    }

    #[Route('proj/init', name: 'projGame_post', methods: ['POST'])]
    public function pStart(
        SessionInterface $session,
        Request $request
    ): Response {
        $nrOfPlayers = $request->get('nrOfPlayers');
        $playerName = $request->get('name');
        $session->set('deck', new GraphicDeckOfCards());
        $session->set('nrOfPlayers', $nrOfPlayers);
        $session->set('current_player', 0);
        $session->set('player_bet', 0);
        $session->set('player_name', $playerName);


        for ($i=0; $i<$nrOfPlayers; $i++) {
            $session->set('player-' . $i, new CardHand());
            $session->set('player_points-' . $i, 0);
        };

        $session->set('bank_hand', new CardHand());
        $session->set('bank_points', 0);

        return $this->redirectToRoute('projStartGame');
    }

    ################################################

    #[Route('proj/game', name: 'projStartGame')]
    public function pGame(
        SessionInterface $session
    ): Response {
        $current = $session->get('current_player');
        $nrOfPlayers = $session->get('nrOfPlayers');
        $hand = $session->get('player-' . $current);
        $points = $session->get('player_points-' . $current);

        $data = [
            'player' => $current + 1,
            'hand' => $hand->showCards(),
            'points' => $points,
            'nrOfPlayers' => $nrOfPlayers,
            'player_name' => $session->get('player_name'),
            'player_bet' => $session->get('player_bet'),
        ];

        return $this->render('proj/sites/game.html.twig', $data);
    }

    #[Route('proj/draw', name: 'proj_draw', methods: ['POST'])]
    public function drawCard(
        SessionInterface $session
    ): Response {
        $current = $session->get('current_player');
        $hand = $session->get('player-' . $current);
        $deck = $session->get('deck');

        $hand->addCards($deck, 1);
        $addPoints = $deck->points();
        $points = $session->get('player_points-' . $current);

        // @codeCoverageIgnoreStart
        if ($addPoints == 'ace' && $points < 10) {
            $points += 11;
        } elseif ($addPoints == 'ace' && $points >= 10) {
            $points += 1;
        } else {
            $points += $addPoints;
        }
        // @codeCoverageIgnoreEnd

        $session->set('player-' . $current, $hand);
        $session->set('player_points-' . $current, $points);

        // @codeCoverageIgnoreStart
        $nrOfPlayers = $session->get('nrOfPlayers');
        if ($points > 21) {
            if ($current + 1 < $nrOfPlayers) {
                $session->set('current_player', $current + 1);
                return $this->redirectToRoute('projStartGame');
            }
            return $this->redirectToRoute('projBankPlays');
        }
        // @codeCoverageIgnoreEnd

        return $this->redirectToRoute('projStartGame');
    }

    #[Route('proj/hold', name: 'proj_hold', methods: ['POST'])]
    public function hold(
        SessionInterface $session
    ): Response {
        $current = $session->get('current_player');
        $nrOfPlayers = $session->get('nrOfPlayers');

        if ($current + 1 < $nrOfPlayers) {
            $session->set('current_player', $current + 1);
            return $this->redirectToRoute('projStartGame');
        }

        // @codeCoverageIgnoreStart
        return $this->redirectToRoute('projBankPlays');
        // @codeCoverageIgnoreEnd
    }

    #[Route('proj/bet', name: 'proj_bet', methods: ['POST'])]
    public function bet(
        SessionInterface $session
    ): Response {
        $bet = $session->get('player_bet');
        $bet += 5;
        $session->set('player_bet', $bet);

        return $this->redirectToRoute('projStartGame');
    }

    ################################################
    ###################  DEALER  ###################
    ################################################

    #[Route('proj/bank_plays', name: 'projBankPlays')]
    public function bankPlays(
        SessionInterface $session
    ): Response {
        $deck = $session->get('deck');
        $bHand = $session->get('bank_hand');
        $points = $session->get('bank_points');

        while ($points < 18) {
            $bHand->addCards($deck, 1);
            $addPoints = $deck->points();
            // @codeCoverageIgnoreStart
            if ($addPoints == 'ace' && $points < 10) {
                $points += 11;
            } elseif ($addPoints == 'ace' && $points >= 10) {
                $points += 1;
            } else {
                $points += $addPoints;
            }
        }
        // @codeCoverageIgnoreEnd

        $session->set('bank_points', $points);
        $session->set('bank_hand', $bHand);

        return $this->redirectToRoute('projScore');
    }

    #[Route('proj/score', name: 'projScore')]
    public function getScore(
        SessionInterface $session
    ): Response {
        $nrOfPlayers = $session->get('nrOfPlayers');
        $players = [];
        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $players[] = [
                'hand' => $session->get('player-' . $i)->showCards(),
                'points' => $session->get('player_points-' . $i),
            ];
        }

        $data = [
            'players' => $players,
            'bank_hand' => $session->get('bank_hand')->showCards(),
            'bank_points' => $session->get('bank_points'),
            'player_name' => $session->get('player_name'),
            'player_bet' => $session->get('player_bet'),
        ];

        return $this->render('proj/sites/score.html.twig', $data);
    }
}
