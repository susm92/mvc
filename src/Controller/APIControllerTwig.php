<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\CardHand;
use App\Deck\DeckOfCards;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class APIControllerTwig extends AbstractController
{
    #[Route('/api', name: 'api_home', methods: ['GET'])]
    public function apiHome(): Response
    {
        return $this->render('cardGame/api/home.html.twig');
    }

    #[Route('/api/deck', name: 'api_deck', methods:['GET'])]
    public function getAPIDeck(): response
    {
        $deck = new DeckOfCards();

        $data = [
            "deck" => $deck->showDeck(),
            "count" => sizeof($deck->showDeck()),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/shuffle', name: 'api_shuffle_post', methods:['POST'])]
    public function getAPIDeckShuffle(
        SessionInterface $session
    ): response {
        $session->remove('api_card');
        $session->remove('api_cardhand');

        return $this->RedirectToRoute('api_shuffle_get');
    }

    #[Route('/api/deck/shuffle', name: 'api_shuffle_get', methods:['GET'])]
    public function postAPIDeckShuffle(): response
    {
        $deck = new DeckOfCards();

        $data = [
            "deck" => $deck->shuffleDeck(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/draw', name: 'api_deck_draw_post', methods:['POST'])]
    public function postAPIDeckDraw(
        SessionInterface $session
    ): response {

        if (!$session->get('api_card') || !$session->get('api_cardhand') || $session->get('api_card') == null || $session->get('api_cardhand') == null) {
            $session->set('api_card', new Card());
            $session->set('api_cardhand', new CardHand());
        }

        return $this->RedirectToRoute('api_deck_draw_get');
    }

    #[Route('/api/deck/draw', name: 'api_deck_draw_get', methods:['GET'])]
    public function getAPIDeckDraw(
        SessionInterface $session
    ): response {

        $card = $session->get("api_card");
        $hand = $session->get("api_cardhand");

        $card->draw();
        $hand->addCard($card->showValue());

        $data = [
            "showValue" => $card->showValue(),
            "cardAmount" => $card->getAmount(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('api/deck/draw/{num<\d+>}', name: 'api_number_cards_post', methods: ['POST'])]
    public function getAPIManyCards(
        int $num,
    ): Response {
        return $this->RedirectToRoute('api_number_cards_get', ['num' => $num]);
    }

    #[Route('api/deck/draw/{num<\d+>}', name: 'api_number_cards_get', methods: ['GET'])]
    public function postAPIManyCards(
        Request $request,
        SessionInterface $session
    ): Response {
        $num = $request->get('num');

        if ($num > 52) {
            throw new \Exception("Not enough cards!");
        }

        if (!$session->get('api_card') || !$session->get('api_cardhand') || $session->get('api_card') == null || $session->get('api_cardhand') == null) {
            $session->set('api_card', new Card());
            $session->set('api_cardhand', new CardHand());
        }

        $hand = $session->get('api_cardhand');
        $hand->addCards($session->get('api_card'), $num);

        $data = [
            "hand" => $hand->showCards(),
            "amount" => $hand->showCount(),
        ];


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
