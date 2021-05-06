<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemUpdater
{
    protected $item;

    /**
     * ItemUpdater constructor.
     *
     * @param $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    public function update()
    {
        // update...

        return $this->item;
    }

    protected function upQuality()
    {
        if ($this->item->quality < Item::QUALITY_MAX) {
            ++$this->item->quality;
        }

        return $this->item;
    }

    protected function downQuality()
    {
        if ($this->item->quality > Item::QUALITY_MIN) {
            --$this->item->quality;
        }

        return $this->item;
    }

    protected function downSellIn()
    {
        --$this->item->sellIn;

        return $this->item;
    }
}
