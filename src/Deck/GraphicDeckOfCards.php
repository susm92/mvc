<?php

namespace App\Deck;

/**
 * Class used for svg images of pictures instead of strings.
 *
 * {@inheritDoc}
 */
class GraphicDeckOfCards extends Card
{
    protected $cardValue;
    protected $value = [
        's_ace', 's_2', 's_3', 's_4', 's_5', 's_6', 's_7', 's_8', 's_9', 's_10', 's_jack', 's_queen', 's_king',
        'h_ace', 'h_2', 'h_3', 'h_4', 'h_5', 'h_6', 'h_7', 'h_8', 'h_9', 'h_10', 'h_jack', 'h_queen', 'h_king',
        'c_ace', 'c_2', 'c_3', 'c_4', 'c_5', 'c_6', 'c_7', 'c_8', 'c_9', 'c_10', 'c_jack', 'c_queen', 'c_king',
        'd_ace', 'd_2', 'd_3', 'd_4', 'd_5', 'd_6', 'd_7', 'd_8', 'd_9', 'd_10', 'd_jack', 'd_queen', 'd_king'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Shows the current deck of cards.
     */
    public function showDeck(): array
    {
        return $this->value;
    }

    /**
     * adds a card to graphicdeckofcards
     * used for testing
     */
    public function addCard(string $card): void
    {
        $this->cardValue = $card;
        unset($this->value[array_search($this->cardValue, $this->value)]);
    }

    /**
     * Shuffles the above array @var value[] and returns it.
     */
    public function shuffleDeck(): array
    {
        shuffle($this->value);
        return $this->value;
    }

    /**
     * Calculates the points for the current card in @var cardValue, depending on the card drawn.
     */
    public function points()
    {
        if ($this->cardValue == null) {
            return 0;
        } else {
            $points = substr($this->cardValue, 2);

            if ($points == 'jack' || $points == 'queen' || $points == 'king') {
                return 10;
            } elseif ($points == 'ace') {
                return $points;
            } else {
                return intval($points);
            }
        }
    }
}
