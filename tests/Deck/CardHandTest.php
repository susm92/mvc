<?php

namespace App\Deck;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object and verify that is is a card object, 
     */
    public function testCreateObject(): void
    {
        $cardhand = new CardHand();
        $this->assertInstanceOf('\App\Deck\CardHand', $cardhand);
    }

    /**
     * Used to test that addCards function works and that the amount in card is lowered by the number of cards drawn.
     */
    public function testAddCards(): void
    {
        $cardhand = new CardHand();
        $card = new Card();

        $this->assertEmpty($cardhand->showCards());
        $this->assertIsArray($cardhand->showCards());

        $cardhand->addCards($card, 10);
        $this->assertNotEmpty($cardhand->showCards());

        $this->assertEquals($cardhand->showCount(), $card->getAmount());
        $this->assertEquals($cardhand->showCount(), 42);
    }

    /**
     * Checking that the addCard function works.
     */
    public function testAddCard(): void
    {
        $cardhand = new CardHand();

        $cardhand->addCard('2♥');
        $this->assertEquals(['2♥'], $cardhand->showCards());
    }

    /**
     * Test draw card, checking that the card in card is the same as the one in cardhand, so that the same card has been drawn.
     */
    public function testDraw(): void
    {
        $cardhand = new CardHand();
        $card = new Card();

        $cardhand->addCards($card, 0);
        $cardhand->draw();

        $this->assertEquals($cardhand->showCards(), [$card->showValue()]);
    }
}
