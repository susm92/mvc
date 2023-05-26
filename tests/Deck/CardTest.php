<?php

namespace App\Deck;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that is is a card object
     */
    public function testCreateObject(): void
    {
        $card = new Card();
        $this->assertInstanceOf('\App\Deck\Card', $card);

        $res = $card->getCardValue();
        $this->assertEquals(null, $res);
    }

    /**
     * Verify that amount of cards are 13 * 4 and that an int is returned
     */
    public function testGetAmount(): void
    {
        $card = new Card();
        $this->assertEquals(52, $card->getAmount());
    }

    /**
     * verified that draw function returns removed 'cards' from the deck and also that showValue shows a string.
     */
    public function testDraw(): void
    {
        $card = new Card();
        $card->draw();

        $this->assertIsString($card->showValue());
        $this->assertNotEquals(52, $card->getAmount());
    }
}
