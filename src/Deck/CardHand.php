<?php

namespace App\Deck;
use App\Deck\Card;

class CardHand
{
    private $hand = [];
    private $card;

    public function addCards(int $num): void
    {
        $this->card = new Card();
        for ($i = 0; $i < $num; $i++) {
            $this->card->draw();
            $this->hand[] = $this->card->showValue();
        }
    }

    public function showCards(): array
    {
        return $this->hand;
    }

    public function draw(): void
    {
        $this->card->draw();
        $this->hand[] = $this->card->showValue();
    }

    public function showCount(): int
    {
        return $this->card->getAmount();
    }
}