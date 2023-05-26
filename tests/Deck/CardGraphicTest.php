<?php

namespace App\Deck;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that is is a card object
     */
    public function testCreateObject(): void
    {
        $card = new CardGraphic();
        $this->assertInstanceOf('\App\Deck\CardGraphic', $card);

        $res = $card->getCardValue();
        $this->assertEquals(null, $res);
    }
}
