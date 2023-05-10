<?php

namespace App\Deck;

/**
 * Holds the cards drawn.
 * 
 * {@inheritDoc} In addition, does also have methods to shuffle and show the current deck we are working with. 
 */
class DeckOfCards extends Card
{
    /**
     * @var cards[] is used to store the string array with cards available to draw from.
     */
    protected $cards;

    public function __construct()
    {
        $this->cards = $this->value;
    }

    /**
     * Is used to show the current deck of cards.
     */
    public function showDeck(): array
    {
        return $this->cards;
    }

    /**
     * Is used to randomize the deck of cards.
     */
    public function shuffleDeck(): array
    {
        shuffle($this->cards);
        return $this->cards;
    }
}
