<?php

namespace App\Controller;

use App\Deck\Card;

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

    #[Route('game/card/test/draw', name:'test_draw')]
    public function testDraw(): Response
    {
        $card = new Card();

        $data = [
            "card" => $card->draw(),
            "showValue" => $card->showValue(),
        ];

        return $this->render('cardGame/test/draw.html.twig', $data);
    }
}