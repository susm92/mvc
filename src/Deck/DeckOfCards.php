<?php

namespace App\Deck;

class DeckOfCards extends Card
{
    protected $cards;

    public function __construct()
    {
        $this->cards = $this->value;
    }

    public function showDeck(): array
    {
        return $this->cards;
    }

    public function shuffleDeck(): array
    {
        shuffle($this->cards);
        return $this->cards;
    }
}