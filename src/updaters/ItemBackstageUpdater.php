<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemBackstageUpdater extends ItemUpdater
{
    /**
     * @return Item
     */
    public function updateQuality(): Item
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

    /**
     * @return Item
     */
    public function updateExpired(): Item
    {
        $this->item->quality = Item::QUALITY_MIN;

        return $this->item;
    }
}
