<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteControllerTwig
{
    #[Route("/api/quote")]
    public function jsonNumber(): Response
    {
        $quotes = [
            "“All our dreams can come true, if we have the courage to pursue them.” —Walt Disney",
            "“The secret of getting ahead is getting started.” —Mark Twain",
            "“The best time to plant a tree was 20 years ago. The second best time is now.” ―Chinese Proverb",
            "“Only the paranoid survive.” —Andy Grove",
            "“It's hard to beat a person who never gives up.” —Babe Ruth",
            "“I wake up every morning and think to myself, 'How far can I push this company in the next 24 hours.’” —Leah Busque"
        ];

        $rand = array_rand($quotes, 1);
        $t = time();

        $data = [
            'qoute-of-the-day' => $quotes[$rand],
            'generated' => date('H:i:s', $t),
            'date' => date('Y-m-d', $t)
        ];

        // return new JsonResponse($data);
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}