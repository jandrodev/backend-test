<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemBackstageUpdater extends ItemUpdater
{
    public function updateQuality()
    {
        $this->upQuality();

        if ($this->item->sellIn < Item::SELL_IN_MAX) {
            $this->upQuality();
        }

        if ($this->item->sellIn < Item::SELL_IN_MED) {
            $this->upQuality();
        }

        return $this->item;
    }

    public function updateExpired()
    {
        $this->item->quality = Item::QUALITY_MIN;

        return $this->item;
    }
}
