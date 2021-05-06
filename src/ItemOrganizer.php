<?php

namespace Runroom\GildedRose;

use Runroom\GildedRose\Updaters\{ItemAgedUpdater, ItemBackstageUpdater, ItemSulfurasUpdater, ItemUpdater};

class ItemOrganizer
{
    /**
     * @param Item $item
     *
     * @return ItemAgedUpdater|ItemBackstageUpdater|ItemSulfurasUpdater|ItemUpdater
     */
    public function categorize(Item $item)
    {
        switch ($item->name) {
            case Item::NAME_SULFURAS:
                return new ItemSulfurasUpdater($item);
            case Item::NAME_BACKSTAGE:
                return new ItemBackstageUpdater($item);
            case Item::NAME_AGED:
                return new ItemAgedUpdater($item);
            default:
                return new ItemUpdater($item);
        }
    }
}
