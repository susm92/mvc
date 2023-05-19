<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    #[Route("/metrics", name: "metrics_home")]
    public function home(): Response
    {
        return $this->render('/metrics/index.html.twig');
    }
}
