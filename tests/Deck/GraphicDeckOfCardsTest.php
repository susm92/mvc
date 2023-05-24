<?php

namespace App\Deck;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class GraphicDeckOfCards.
 */
class GraphicDeckOfCardsTest extends TestCase
{
    /**
     * Method used to verify that the object is correctly created also that constructor is the same as for parent class.
     */
    public function testCreateObject()
    {
        $graphicdeckofcards = new GraphicDeckOfCards();
        
        $this->assertInstanceOf('\App\Deck\GraphicDeckOfCards', $graphicdeckofcards);
        $this->assertEquals(null, $graphicdeckofcards->getCardValue());
    }

    /**
     * Verify that shuffle deck works as intended
     */
    public function testShuffleDeck()
    {
        $graphicdeckofcards = new GraphicDeckOfCards();

        $unshuffled = $graphicdeckofcards->showDeck();
        $shuffled = $graphicdeckofcards->shuffleDeck();

        $this->assertNotEquals($unshuffled, $shuffled);
    }

    /**
     * Check that points works as intended,
     * numeric value should return int
     * ace should return ace
     * jacks, queen och king all return 10
     * no cards drawn should indicate null
     */
    public function testPoints()
    {
        $graphicdeckofcards = new GraphicDeckOfCards();
        
        $this->assertEquals($graphicdeckofcards->points(), null);

        $graphicdeckofcards->addCard('s_4');
        $this->assertEquals($graphicdeckofcards->points(), 4);

        $graphicdeckofcards->addCard('c_jack');
        $this->assertEquals($graphicdeckofcards->points(), 10);

        $graphicdeckofcards->addCard('h_ace');
        $this->assertEquals($graphicdeckofcards->points(), 'ace');
    }
}
