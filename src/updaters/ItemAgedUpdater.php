<?php

namespace Runroom\GildedRose\Updaters;

class ItemAgedUpdater extends ItemUpdater
{
    public function updateQuality()
    {
        $this->upQuality();

        return $this->item;
    }

    public function updateExpired()
    {
        $this->upQuality();

        return $this->item;
    }
}
