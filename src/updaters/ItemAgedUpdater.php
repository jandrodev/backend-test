<?php

namespace Runroom\GildedRose\Updaters;

class ItemAgedUpdater extends ItemUpdater
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

    public function updateUpQuality()
    {
        $this->upQuality();

        return $this->item;
    }
}
