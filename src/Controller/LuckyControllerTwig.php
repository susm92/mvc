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
        $random_img = ['random_pic_1', 'random_pic_2', 'random_pic_3', 'random_pic_4'];

        $number = random_int(100, 10000);
        $random_pic = $random_img[array_rand($random_img, 1)];

        $data = [
            'number' => $number,
            'pic' => $random_pic
        ];

        return $this->render('lucky.html.twig', $data);
    }
}
