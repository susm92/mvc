<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\CardHand;
use App\Deck\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route('card', name: 'card')]
    public function card(
        SessionInterface $session
    ): Response
    {
        $card = new Card();
        $hand = new CardHand();

        if (!$session->get('card') || !$session->get('CardHand') || empty($session->get('card')) || empty($session->get('CardHand'))) {
            $session->set('card', $card);
            $session->set('CardHand', $hand);
        }

        return $this->render('cardGame/home.html.twig');
    }

    #[Route('card/deck', name: 'deck')]
    public function testDeck(): Response
    {
        $deck = new DeckOfCards();

        $data = [
            "deck" => $deck->showDeck(),
            "count" => sizeof($deck->showDeck()),
        ];

        return $this->render('cardGame/sites/deck.html.twig', $data);
    }

    #[Route('card/deck/shuffle', name: 'shuffle')]
    public function shuffleDeck(
        SessionInterface $session,
    ): Response
    {
        
        $session->remove('card');
        $session->remove('CardHand');
        
        $deck = new DeckOfCards();
        
        $data = [
            "deck" => $deck->shuffleDeck(),
        ];

        return $this->render('cardGame/sites/shuffle.html.twig', $data);
    }

    #[Route('card/deck/draw', name:'draw')]
    public function testDraw(
        SessionInterface $session
    ): Response
    {
        $card = $session->get("card");
        $hand = $session->get("CardHand");

        $data = [
            "card" => $card->draw(),
            "showValue" => $card->showValue(),
            "cardAmount" => $card->getAmount(),
            "addCard" => $hand->addCard($card->showValue()),
        ];

        return $this->render('cardGame/sites/draw.html.twig', $data);
    }

    #[Route('card/deck/draw/{num<\d+>}', name: 'number_cards')]
    public function testManyCards(
        int $num,
        SessionInterface $session
    ): Response
    {
        if ($num > 52)
        {
            throw new \Exception("Not enough cards!");
        }

        $hand = $session->get('CardHand');
        $hand->addCards($session->get('card'), $num);

        $data = [
            "hand" => $hand->showCards(),
            "amount" => $hand->showCount(),
        ];

        return $this->render('cardGame/sites/number.html.twig', $data);
    }
}