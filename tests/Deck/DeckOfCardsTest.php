<?php

namespace App\Deck;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Method used to verify that the object is correct
     */
    public function testCreateObject()
    {
        $deckofcards = new DeckOfCards();
        $this->assertInstanceOf('\App\Deck\DeckOfCards', $deckofcards);
    }

    /**
     * Check that DeckOfCards contains the same list as Cards, so that inheritence is correct.
     */
    public function testShowDeck()
    {
        $card = new Card();
        $deckofcards = new DeckOfCards();

        $this->assertEquals($card->showDeck(), $deckofcards->showDeck());
    }

    /**
     * Checks that shuffle works as intended
     */
    public function testShuffleDeck()
    {
        $deckofcards = new DeckOfCards();

        $unshuffled = $deckofcards->showDeck();
        $shuffled = $deckofcards->shuffleDeck();
        $this->assertNotEquals($unshuffled, $shuffled);
    }
}
