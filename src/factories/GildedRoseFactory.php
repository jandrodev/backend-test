<?php

namespace Runroom\GildedRose\factories;

use Runroom\GildedRose\{GildedRose, Item};

class GildedRoseFactory
{
    /**
     * @param array<Item> $items
     *
     * @return GildedRose
     */
    public static function create(array $items): GildedRose
    {
        return new GildedRose($items);
    }
}
