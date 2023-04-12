<?php

namespace App\Deck;

class Card
{
    protected $cardValue;
    protected $value = [
        'A♠', '2♠', '3♠', '4♠', '5♠', '6♠', '7♠', '8♠', '9♠', '10♠', 'J♠', 'Q♠', 'K♠',
        'A♥', '2♥', '3♥', '4♥', '5♥', '6♥', '7♥', '8♥', '9♥', '10♥', 'J♥', 'Q♥', 'K♥',
        'A♣', '2♣', '3♣', '4♣', '5♣', '6♣', '7♣', '8♣', '9♣', '10♣', 'J♣', 'Q♣', 'K♣',
        'A♦', '2♦', '3♦', '4♦', '5♦', '6♦', '7♦', '8♦', '9♦', '10♦', 'J♦', 'Q♦', 'K♦'
    ];

    public function __construct()
    {
        $this->cardValue = null;
    }

    public function draw(): void
    {
        if (sizeof($this->value) != 0)
        {
        $this->cardValue = $this->value[array_rand($this->value, 1)];
        unset($this->value[array_search($this->cardValue, $this->value)]);
        }
    }

    public function showValue(): string
    {
        return $this->cardValue;
    }

    public function getAmount(): int
    {
        return count($this->value);
    }
}