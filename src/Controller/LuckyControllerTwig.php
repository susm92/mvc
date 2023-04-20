<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $randomImg = ['random_pic_1', 'random_pic_2', 'random_pic_3', 'random_pic_4'];

        $number = random_int(100, 10000);
        $randomPic = $randomImg[array_rand($randomImg, 1)];

        $data = [
            'number' => $number,
            'pic' => $randomPic
        ];

        return $this->render('lucky.html.twig', $data);
    }
}
