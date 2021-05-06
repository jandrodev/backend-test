<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemAgedUpdater extends ItemUpdater
{
    /**
     * @return Item
     */
    public function updateQuality(): Item
    {
        $this->upQuality();

        return $this->item;
    }

    /**
     * @return Item
     */
    public function updateExpired(): Item
    {
        $this->upQuality();

        return $this->item;
    }
}
