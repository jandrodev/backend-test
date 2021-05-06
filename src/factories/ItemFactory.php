<?php

namespace Runroom\GildedRose\factories;

use Runroom\GildedRose\Item;

class ItemFactory
{
    /**
     * @param string $name
     * @param int $sellIn
     * @param int $quality
     *
     * @return Item
     */
    public static function create(string $name, int $sellIn, int $quality): Item
    {
        return new Item($name, $sellIn, $quality);
    }
}
