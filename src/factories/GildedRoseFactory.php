<?php

namespace Runroom\GildedRose\factories;

use Runroom\GildedRose\GildedRose;

class GildedRoseFactory
{
    /**
     * @param array $items
     *
     * @return GildedRose
     */
    public static function create(array $items): GildedRose
    {
        return new GildedRose($items);
    }
}
