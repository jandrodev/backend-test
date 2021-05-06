<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemBackstageUpdater extends ItemUpdater
{
    public function update()
    {
        // Maybe I don´t need it...
        return parent::update();
    }

    public function updateQuality()
    {
        $this->upQuality();

        return $this->item;
    }

    public function updateMinQuality()
    {
        $this->item->quality = Item::QUALITY_MIN;

        return $this->item;
    }
}
