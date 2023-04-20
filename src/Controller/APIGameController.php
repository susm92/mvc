<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\CardHand;
use App\Deck\DeckOfCards;
use App\Deck\GraphicDeckOfCards;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class APIGameController extends AbstractController
{
   #[Route('/api/game', name: 'get_api_game', methods: ['GET'])]
   public function getGame(
    SessionInterface $session
   ): response
   {
        $data = [
            'player hand' => $session->get('player_hand')->showCards(),
            'player points' => $session->get('player_points'),
            'banks hand' => $session->get('bank_hand')->showCards(),
            'bank points' => $session->get('bank_points'),
            'cards in deck' => $session->get('deck')->getAmount(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
   }
}
