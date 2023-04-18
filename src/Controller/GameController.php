<?php

namespace App\Controller;

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

    #[Route('game/start_game', name: 'start_game')]
    public function startGame(): Response
    {
        // return $this->render('game/start.html.twig');
        return $this->redirectToRoute('game');
    }
}
