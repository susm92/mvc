<?php

namespace App\Controller;

use App\Deck\Card;
use App\Deck\CardGraphic;
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
    public function card(): Response
    {

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
    ): Response {

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
    ): Response {

        $card = $this->getCard($session);
        $hand = $this->getHand($session);

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
    ): Response {
        if ($num > 52) {
            throw new \Exception("Not enough cards!");
        }

        $hand = $this->getHand($session);
        $hand->addCards($this->getCard($session), $num);

        $data = [
            "hand" => $hand->showCards(),
            "amount" => $hand->showCount(),
        ];

        return $this->render('cardGame/sites/number.html.twig', $data);
    }

    //
    // RE-Factored functions for Hand & CardHand
    //

    /**
     * Private method used to extract the card
     * Depends session is set or not
     */
    private function getCard(SessionInterface $session): Card
    {
        if (!$session->has('card') || $session->get('card') == null) {
            $session->set('card', new Card());
        }

        return $session->get('card');
    }

    /**
     * Private method used to extract the cardhand
     * Depends session is set or not
     */
    private function getHand(SessionInterface $session): CardHand
    {
        if (!$session->has('CardHand') || $session->get('CardHand') == null) {
            $session->set('CardHand', new CardHand());
        }

        return $session->get('CardHand');
    }
}
