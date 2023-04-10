<?php

namespace App\Controller;

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
}