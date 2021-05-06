<?php

namespace Runroom\GildedRose;

use Runroom\GildedRose\Updaters\{ItemAgedUpdater, ItemBackstageUpdater, ItemSulfurasUpdater, ItemUpdater};

class ItemOrganizer
{
    /**
     * @param $item
     *
     * @return ItemAgedUpdater|ItemBackstageUpdater|ItemSulfurasUpdater|ItemUpdater
     */
    public function categorize($item)
    {
        if ($item->name == Item::NAME_SULFURAS) {
            $updater = new ItemSulfurasUpdater($item);
        } elseif ($item->name == Item::NAME_BACKSTAGE) {
            $updater = new ItemBackstageUpdater($item);
        } elseif ($item->name == Item::NAME_AGED) {
            $updater = new ItemAgedUpdater($item);
        } else {
            $updater = new ItemUpdater($item);
        }

        return $updater;
    }
}
