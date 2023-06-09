<?php

namespace App\Deck;

/**
 * Card used for svg-images instead of string, works just as before as cards.
 *
 * {@inheritDoc}
 */
class CardGraphic extends Card
{
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

}
