<?php

namespace App\Deck;

/**
 * Card class for my Deck game.
 * 
 * Is used to hold an array of different cards, after each draw the array shrinks.
 * 
 * @author susm20
 */
class Card
{
    /**
     * @var cardValue used to hold current cardvalue.
     */
    protected $cardValue;

    /**
     * @var value[] array with strings that holds different card suits and values.
     */
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

    /**
     * Randomly assignes a value from @var value[] to @var cardValue
     * The assigned value is later removed from @var value[].
     */
    public function draw(): void
    {
        if (sizeof($this->value) != 0) {
            $this->cardValue = $this->value[array_rand($this->value, 1)];

            unset($this->value[array_search($this->cardValue, $this->value)]);
        }
    }

    /**
     * Real getter function for the @var cardvalue
     * Only used for testing purpose..
     * 
     * @return null
     */
    public function getCardValue()
    {
        return $this->cardValue;
    }

    /**
     * Returns the current value of @var cardValue
     * Can be seen as a 'getter' function
     */
    public function showValue(): string
    {
        return $this->cardValue;
    }

    /**
     * Returns the current size of @var value[]
     */
    public function getAmount(): int
    {
        return count($this->value);
    }

    /**
     * Is used to show the current deck of cards.
     */
    public function showDeck(): array
    {
        return $this->value;
    }
}
