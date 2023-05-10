<?php

namespace App\Deck;

use App\Deck\Card;
/**
 * CardHand class for my deck game.
 * 
 * Is used to hold all the cards that have been drawed from the card object that is being sent in to the class.
 * The methods for used in this class are:
 *  * addCards
 *  * addCard
 *  * showCards
 *  * draw
 *  * showCount
 */
class CardHand
{
    /**
     * @var hand[] used to hold strings of drawed cards.
     */
    private $hand = [];

    /**
     * @var card is used to store the Card object in this class.
     */
    private $card;

    /**
     * Stores card object to @var card, then draws the number a number of cards.
     * 
     * @param object    $card   stores an card object to the variable
     * @param int       $num    the amounts of times to draw a new card
     */
    public function addCards(Card $card, int $num): void
    {
        $this->card = $card;
        for ($i = 0; $i < $num; $i++) {
            $this->card->draw();
            $this->hand[] = $this->card->showValue();
        }
    }

    /**
     * Adds a card to the @var hand[]
     * 
     * @param string    $card   adds a new string value to the @var hand[]
     */
    public function addCard(string $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * Returns the current values in my hand.
     */
    public function showCards(): array
    {
        return $this->hand;
    }

    /**
     * Draws a new card with the card object and adds it to the hand.
     */
    public function draw(): void
    {
        $this->card->draw();
        $this->hand[] = $this->card->showValue();
    }

    /**
     * Returns the amount of cards left in the card class
     */
    public function showCount(): int
    {
        return $this->card->getAmount();
    }
}
