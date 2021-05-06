<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemSulfurasUpdater extends ItemUpdater
{
    /**
     * @return Item
     */
    public function update(): Item
    {
        return $this->item;
    }
}
