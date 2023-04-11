<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route('game/card', name: 'card')]
    public function home(): Response
    {
        return $this->render('cardGame/home.html.twig');
    }

    #[Route('card/draw', name:'draw')]
    public function testDraw(): Response
    {
        $card = new Card();

        $data = [
            "card" => $card->draw(),
            "showValue" => $card->showValue(),
            "cardAmount" => $card->getAmount(),
        ];

        return $this->render('cardGame/sites/draw.html.twig', $data);
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

    #[Route('card/shuffle', name: 'shuffle')]
    public function shuffleDeck(): Response
    {
        $deck = new DeckOfCards();

        $data = [
            "deck" => $deck->shuffleDeck(),
        ];

        return $this->render('cardGame/sites/shuffle.html.twig', $data);
    }
}