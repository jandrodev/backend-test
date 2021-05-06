<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemBackstageUpdater extends ItemUpdater
{
    public function updateQuality()
    {
        $this->upQuality();

        return $this->item;
    }

    public function updateExpired()
    {
        $this->item->quality = Item::QUALITY_MIN;

        return $this->item;
    }
}
